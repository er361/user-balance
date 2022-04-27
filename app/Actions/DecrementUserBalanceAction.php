<?php

namespace App\Actions;

use App\Actions\Abstracts\AbstractBalanceOperation;
use App\Models\AccountOperation;
use App\Models\UserAccount;
use Exception;
use Illuminate\Support\Str;

class DecrementUserBalanceAction extends AbstractBalanceOperation
{
    public function execute(int $accountId, int $sum, string $reason)
    {
        $balance = UserAccount::findOrFail($accountId)->balance;
        if (($balance - $sum) > 0) {
            parent::do($accountId, $sum, $reason, AccountOperation::TYPE_DECREMNT);
        } else {
            \Log::info('Попытка списать сумму больше чем на балансе', [
                'accountId' => $accountId,
                'sum'       => $sum,
                'reason'    => Str::limit($reason, 200),
            ]);

            throw new Exception('Не удалось списать баланс, недостаточно средств');
        }
    }
}
