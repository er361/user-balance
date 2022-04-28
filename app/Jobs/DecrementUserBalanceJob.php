<?php

namespace App\Jobs;

use App\Actions\DecrementUserBalanceAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DecrementUserBalanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public int $accountId,
        public int $sum,
        public string $reason
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DecrementUserBalanceAction $action)
    {
        //
        $action->execute(
            $this->accountId,
            $this->sum,
            $this->reason
        );
    }
}
