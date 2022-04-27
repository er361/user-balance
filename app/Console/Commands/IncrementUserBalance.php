<?php

namespace App\Console\Commands;

use App\Actions\IncrementUserBalanceAction;
use App\Console\Commands\Abstracts\UserBalanceOperationCommand;

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
    public function handle(IncrementUserBalanceAction $action)
    {
        parent::do($action);
    }
}
