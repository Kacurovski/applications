<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateLink
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
        $user = $event->user;
        $activationLink = Str::random(20);
        $user->update([
            'activation_link' => $activationLink,
            'activation_link_created' => now(),
        ]);
    }
}
