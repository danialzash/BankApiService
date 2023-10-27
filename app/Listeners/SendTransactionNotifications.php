<?php

namespace App\Listeners;

use App\Events\TransactionSuccessEvent;
use App\Models\TransactionFee;
use App\Notifications\TransactionNotification;
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
        $fromToUser = $event->transaction->fromUser();
        $toUser = $event->transaction->toUser();

        $fromToUser->notify(new TransactionNotification());
        $toUser->notify(new TransactionNotification());
    }
}
