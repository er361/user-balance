<?php

namespace App\Console\Commands\Abstracts;

use App\Actions\Abstracts\AbstractBalanceOperation;
use App\Models\User;
use Illuminate\Console\Command;

abstract class UserBalanceOperationCommand extends Command
{

    /**
     * @param string $action
     *
     * @return void
     */
    public function do(AbstractBalanceOperation $action)
    {
        $user = User::whereEmail($this->argument('email'))->firstOrFail();

        $action->execute(
            $user->account?->id,
            $this->argument('sum'),
            $this->argument('reason')
        );
    }
}
