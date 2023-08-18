<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use App\Mail\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailOnRegisteration implements ShouldQueue
{
    use InteractsWithQueue;
    public $afterCommit =   true;
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
    public function handle(UserRegistration $event): void
    {
        if ($event->email) {
            $this->release(1);
            Mail::to($event->email)->send(new UserRegistered(auth()->user()->name));
        }
    }
}
