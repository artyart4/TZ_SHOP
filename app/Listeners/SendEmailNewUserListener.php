<?php

namespace App\Listeners;

use App\Notifications\SendEmailNewUserNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNewUserListener
{
    public function handle(Registered $event)
    {
      $event->user->notify(new SendEmailNewUserNotification());
    }
}
