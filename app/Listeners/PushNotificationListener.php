<?php

namespace App\Listeners;

use App\Events\PushNotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PushNotificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PushNotificationEvent  $event
     * @return void
     */
    public function handle(PushNotificationEvent $event)
    {
        $action = new \App\Action;
        $action->message = $event->message()->get();
        \Auth::user()->actions()->save($action);
        $users = \App\User::all()->except(\Auth::user()->id);
        $action->broadcastUser()->saveMany($users);
    }
}
