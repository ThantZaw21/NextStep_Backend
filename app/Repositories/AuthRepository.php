<?php

namespace App\Repositories;
use App\Models\User;

class AuthRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createUser(array $data): User{
        return User::create($data);
    }

    public function findUserByEmail(string $email): ?User{
        return User::where('email', $email)->first();
    }

    //mark user email as verified
    public function markEmailAsVerified(User $user): void{
        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();
    }


}
