<?php

namespace App\Actions;

use App\Actions\Abstracts\AbstractBalanceOperation;
use App\Models\AccountOperation;

class IncrementUserBalanceAction extends AbstractBalanceOperation
{
    public function execute(int $accountId, int $sum, string $reason)
    {
        parent::do($accountId, $sum, $reason, AccountOperation::TYPE_INCREMENT);
    }
}
