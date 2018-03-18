<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

use \SplPriorityQueue as SplPriorityQueue;

class PriorityQueue extends SplPriorityQueue implements PriorityQueueInterface
{
    public function serialize()
    {
        $objects = [];
        $heap = clone $this;
        $heap->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $heap->top();

        while($heap->valid()){
            $node = (object) $heap->current();
            $objects[] = (object) [
                'data' => $node->data,
                'priority' => $node->priority,
            ];
            $heap->next();
        }

         return serialize($objects);
    }

    public function unserialize($serializedData)
    {
        $objects = unserialize($serializedData);

        foreach ($objects as $node) {
            $this->insert($node->data, $node->priority);
        }
    }
}
