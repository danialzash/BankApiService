<?php

namespace App\Listeners;

use App\Events\TransactionSuccessEvent;
use App\Models\TransactionFee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTransactionNotifications
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionSuccessEvent $event): void
    {
        $transactionFee = new TransactionFee([
            'transaction_id' => $event->transaction->id,
            'cost' => config('transaction.constant_fee'),
        ]);

        $transactionFee->save();
    }
}
