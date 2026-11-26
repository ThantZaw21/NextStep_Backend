<?php

namespace App\Repositories;
use App\Models\EmailVerification;

class EmailVerificationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    //create a new OTP record or update exisiting record
    public function updateOrCreate(int $userId, array $data): EmailVerification{
        return EmailVerification::updateOrCreate(
            ['user_id' => $userId],
            $data
        );
    }

    //find OTP belonging to particular user
    public function findByUserId(int $userId): ?EmailVerification{
        return EmailVerification::where('user_id', $userId)->first();
    }

    //create failed verification counts directly into database
    public function incrementAttempts(int $userId): void{
        EmailVerification::where('user_id', $userId)->increment('attempts');
    }

    //after successful OTP verification we will delete not to use same otp again
    public function deleteByUserId(int $userId):void{
        EmailVerification::where('user_id', $userId)->delete();
    }
}
