<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    /**
     * @param string $email
     * @param string $password
     *
     * @return User
     * @throws \Exception
     */
    public function execute(string $email, string $password): User
    {
        if (User::whereEmail($email)->exists()) {
            throw new \Exception(sprintf('Email %s already exists', $email));
        }

        return User::create([
            'email'    => $email,
            'password' => Hash::make($password),
        ]);
    }
}
