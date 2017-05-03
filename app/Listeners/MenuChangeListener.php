<?php

namespace App\Listeners;

use App\Events\MenuChangeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class MenuChangeListener
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
     * @param  MenuChangeEvent  $event
     * @return void
     */
    public function handle(MenuChangeEvent $event)
    {
        Cache::store('file')->forget('leftMenus');
    }
}
