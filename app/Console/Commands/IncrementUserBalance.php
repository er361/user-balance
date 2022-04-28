<?php

namespace App\Console\Commands;

use App\Console\Commands\Abstracts\UserBalanceOperationCommand;
use App\Jobs\IncrementUserBalanceJob;
use App\Models\User;

class IncrementUserBalance extends UserBalanceOperationCommand
{
    protected $signature = 'ub:increment-balance {email}{sum}{reason}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment user balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::whereEmail($this->argument('email'))->firstOrFail();

        IncrementUserBalanceJob::dispatch(
            $user->account->id,
            $this->argument('sum'),
            $this->argument('reason')
        )->onQueue('balance');
    }
}
