<?php

namespace App\Console\Commands;

use App\Jobs\DecrementUserBalanceJob;
use App\Models\User;
use Illuminate\Console\Command;

class DecrementUserBalance extends Command
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
    public function handle()
    {
        $user = User::whereEmail($this->argument('email'))->firstOrFail();

        DecrementUserBalanceJob::dispatch(
            $user->account->id,
            $this->argument('sum'),
            $this->argument('reason')
        )->onQueue('balance');
    }
}
