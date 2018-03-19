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

    /**
     * Returns & removes the head of the queue.
     * @return string
     */
    public function remove()
    {
        $head = $this->queue->current();
        $this->queue->next();

        return $head;
    }

    /**
     * Returns the head of the queue without removing.
     * @return string
     */
    public function peek()
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

    public function toArray()
    {
        return $this->queue->toArray();
    }
}
