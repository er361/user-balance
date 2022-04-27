<?php

namespace App\Actions\Abstracts;

use App\Models\AccountOperation;
use App\Models\UserAccount;

abstract class AbstractBalanceOperation
{

    /**
     * @param int    $accountId
     * @param int    $sum
     * @param string $reason
     * @param int    $type
     *
     * @return void
     */
    public function do(int $accountId, int $sum, string $reason, string $type)
    {
        $accountOperation = new AccountOperation();
        $accountOperation->type = $type;
        $accountOperation->sum = $sum;
        $accountOperation->reason = $reason;
        $accountOperation->account_id = $accountId;
        $accountOperation->save();

        $userAccount = UserAccount::findOrFail($accountId);
        if ($type == AccountOperation::TYPE_INCREMENT) {
            $userAccount->balance += $sum;
        } else {
            if ($type == AccountOperation::TYPE_DECREMNT) {
                $userAccount->balance -= $sum;
            }
        }
        $userAccount->save();
    }

    /**
     * @param int    $accountId
     * @param int    $sum
     * @param string $reason
     *
     * @return mixed
     */
    abstract public function execute(int $accountId, int $sum, string $reason);
}
