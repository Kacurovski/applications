<?php

namespace App\Listeners;

use App\Events\UserActivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateUser
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
    public function handle(UserActivated $event): void
    {
        $user = $event->user;
        $user->update(['is_active' => true]);
    }
}
