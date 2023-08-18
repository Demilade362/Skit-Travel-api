<?php

namespace App\Listeners;

use App\Events\NotifyUser;
use App\Notifications\SendNotifyToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToUser
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
    public function handle(NotifyUser $event): void
    {
        $user = auth()->user();
        Notification::send($user, new SendNotifyToUser($event->user, $event->msg));
    }
}
