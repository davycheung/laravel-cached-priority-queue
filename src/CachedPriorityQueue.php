<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

use Cache;
use DavidCheung\LaravelCachedPriorityQueue\PriorityQueue;

class CachedPriorityQueue
{
    protected $cacheKey;
    protected $queue;

    public function __construct($cacheKey)
    {
        $this->cacheKey = $cacheKey;
        $this->queue = new PriorityQueue();
        $this->load();
    }

    public function next()
    {
        return $this->queue->next();
    }

    public function current()
    {
        return $this->queue->current();
    }

    /**
     * Insert an item into the queue with priority.
     *
     * @param mixed $item
     * @param int    $priority
     * @return void
     */
    public function insert($item, int $priority)
    {
        $this->queue->insert($item, $priority);
    }

    /**
     * Cache existing queue.
     *
     * @return void
     */
    public function save()
    {
        Cache::forever($this->cacheKey, $this->queue->serialize());
    }

    /**
     * Retrieve queue from cache.
     *
     * @return void
     */
    public function load()
    {
        $data = Cache::get($this->cacheKey);
        if ($data) {
            $this->queue->unserialize($data);
        }
    }
}
