<?php

namespace App\Services;
use App\Events\OtpVerificationRequested;
use App\Models\User;
use App\Repositories\EmailVerificationRepository;
use Illuminate\Support\Facades\Hash;


class EmailVerificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected EmailVerificationRepository $emailVerificationRepository
    ) {
    }

    //generate OTP
    public function generateOtp(): string
    {
        return (string) random_int(100000, 999999);
    }

    //store user OTP
    public function createOtp(User $user): string
    {
        if (!$this->canResendOtp($user)) {
            throw new \RuntimeException('Please wait before requesting another OTP.');
        }
        $otp = $this->generateOtp();

        $this->emailVerificationRepository->updateOrCreate(
            $user->id,
            [
                'otp_hash' => Hash::make($otp),
                'expires_at' => now()->addMinutes(5),
                'last_sent_at' => now(),
                'attempts' => 0,
            ]
        );

        event(new OtpVerificationRequested($user, $otp));

        return $otp;

    }

    //prevent user from requesting OTP repeatedly,the 60s resend cooldown
    public function canResendOtp(User $user): bool
    {
        $verification = $this->emailVerificationRepository->findByUserId($user->id);

        if (!$verification || !$verification->last_sent_at) {
            return true;
        }

        return $verification->last_sent_at
            ->copy()
            ->addSeconds(60)
            ->isPast();
    }

    //checking to verify OTP
    public function verifyOtp(User $user, string $otp): bool
    {
        //find user's otp record
        $verification = $this->emailVerificationRepository->findByUserId($user->id);

        //if no otp record exist,return false
        if (!$verification) {
            return false;
        }

        //OTP expired?Delete then
        if ($verification->expires_at->isPast()) {
            $this->emailVerificationRepository->deleteByUserId($user->id);
            return false;
        }

        //if too many attemps,reach maximun attemps?
        if ($verification->attempts >= 5) {
            return false;
        }

        //compare the submitted OTP with stored,hashed otp
        if (!Hash::check($otp, $verification->otp_hash)) {
            $this->emailVerificationRepository->incrementAttempts($user->id);
            return false;
        }

        //OTP is valid,so delete it to avoid to prevent reuse
        $this->emailVerificationRepository->deleteByUserId($user->id);
        return true;
    }
}
