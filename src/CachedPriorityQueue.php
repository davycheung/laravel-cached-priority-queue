<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

use Cache;

class CachedPriorityQueue
{
    protected $cacheKey;
    protected $queue;

    public function __construct($cacheKey)
    {
        $this->cacheKey = $cacheKey;
        $this->load();
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
     * Dequeue next item from queue.
     *
     * @return mixed
     */
    public function next()
    {
        $item = $this->queue->next();

        return $item;
    }

    /**
     * Cache an empty queue, effectively clearing out the queue.
     *
     * @return void
     */
    public function clear()
    {
        $this->queue = new PriorityQueue();
        $this->save();
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
        $this->queue = new PriorityQueue();

        $data = Cache::get($this->cacheKey);
        if ($data) {
            $this->queue->unserialize($data);
        }
    }
}
