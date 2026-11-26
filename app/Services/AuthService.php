<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use App\Services\EmailVerificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthRepository $authRepository,
        protected EmailVerificationService $emailVerificationService
    ) {
    }

    public function register(array $data): User
    {
        //assign default user role
        $data['role'] = 'job_seeker';
        //create user account
        $user = $this->authRepository->createUser($data);

        //generate otp and send verification mail
        $this->emailVerificationService->createOtp($user);

        return $user;
    }

    public function verifyEmail(string $email, string $otp): bool
    {
        //find user 
        $user = $this->authRepository->findUserByEmail($email);

        if (!$user) {
            return false;
        }

        //verify submitted OTP
        $isValid = $this->emailVerificationService->verifyOtp($user, $otp);

        if (!$isValid) {
            return false;
        }

        //mark email as verified
        $this->authRepository->markEmailAsVerified($user);
        return true;
    }

    public function resendOtp(string $email): bool
    {
        //find user by email
        $user = $this->authRepository->findUserByEmail($email);

        if (!$user || $user->email_verified_at) {
            return false;
        }

        //generate and send new OTP
        $this->emailVerificationService->createOtp($user);
        return true;
    }

    //login
    public function login(array $data): User
    {
        $user = $this->authRepository->findUserByEmail($data['email']);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The email or password you entered is incorrect. Please try again.'],
            ]);
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect password.']
            ]);
        }

        if(!$user->hasVerifiedEmail()){
            throw ValidationException::withMessages([
                'email' => ['Please verify your email address before logging in'],
            ]);
        }

        Auth::login($user);
        return $user;
    }
}
