<?php

namespace App\Listeners;

use App\Mail\ActivateUser;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationEmail
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
    public function handle(UserCreated $event): void
    {
        $activationLink = route('validation.link', [
            'email' => $event->user->email,
            'code' => $event->user->activation_link,
        ]);
    
        Mail::to($event->user->email)->send(new ActivateUser($event->user->username, $activationLink));
    }
}
