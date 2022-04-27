<?php

namespace App\Console\Commands;

use App\Actions\DecrementUserBalanceAction;
use App\Console\Commands\Abstracts\UserBalanceOperationCommand;

class DecrementUserBalance extends UserBalanceOperationCommand
{
    protected $signature = 'ub:decrement-balance {email}{sum}{reason}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decrement user balance';

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
    public function handle(DecrementUserBalanceAction $action)
    {
        parent::do($action);
    }
}
