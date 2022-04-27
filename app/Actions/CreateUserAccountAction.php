<?php

namespace App\Actions;

use App\Models\UserAccount;

class CreateUserAccountAction
{
    /**
     * @param int $userId
     * @param     $balance
     *
     * @return UserAccount
     */
    public function execute(int $userId, $balance): UserAccount
    {
        return UserAccount::create(['user_id' => $userId, 'balance' => $balance]);
    }
}
