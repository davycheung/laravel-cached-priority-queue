<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

interface PriorityQueueInterface
{
    public function insert($item, $priority);
    public function serialize();
    public function unserialize($serializedData);
}
