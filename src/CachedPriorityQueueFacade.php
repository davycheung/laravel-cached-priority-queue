<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

use Illuminate\Support\Facades\Facade;

class CachedPriorityQueueFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CachedPriorityQueue';
    }
}
