<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendOtpRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());

        //userresource control data returned
        //user resource returned by the API
        return (new UserResource($user))
            ->additional([
                'success' => true,
                'message' => 'Registration successful.Please check your email for the verification code.',
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function verifyEmail(VerifyOtpRequest $request): JsonResponse
    {
        $data = $request->validated();
        $isVerified = $this->authService->verifyEmail(
            $data['email'],
            $data['otp']
        );

        if (!$isVerified) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired verification code.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully'
        ]);
    }

    public function resendOtp(ResendOtpRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $isSent = $this->authService->resendOtp($data['email']);
        } catch (\RuntimeException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 429);
        }

        if (!$isSent) {
            return response()->json([
                'success' => false,
                'message' => 'Email is already verified.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'A new verification code has been sent.',
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->login($request->validated());

        // Regenerate session ID for security
        $request->session()->regenerate();

        return (new UserResource($user))
            ->additional([
                'success' => true,
                'message' => 'Welcome back! You have successfully signed in.',
            ])
            ->response()
            ->setStatusCode(200);
    }
}
