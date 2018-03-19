<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

interface PriorityQueueInterface
{
    public function next();
    public function current();
    public function compare($priority1, $priority2);
    public function insert($item, $priority);
    public function serialize();
    public function unserialize($serializedData);
    public function toArray();
}
