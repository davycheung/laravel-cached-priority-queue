<?php

namespace DavidCheung\LaravelCachedPriorityQueue;

use \SplPriorityQueue as SplPriorityQueue;

class PriorityQueue extends SplPriorityQueue implements PriorityQueueInterface
{
    /**
     * Returns an array containing the ordered nodes in the queue.
     * @return array
     */
    public function toArray() : array
    {
        $objects = [];
        $heap = clone $this;
        $heap->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $heap->rewind();

        while($heap->valid()){
            $node = (object) $heap->current();
            $objects[] = (object) [
                'data' => $node->data,
                'priority' => $node->priority,
            ];
            $heap->next();
        }

        return $objects;
    }

    /**
     * Minimum Priority Queue
     * @param  [int] $priority1
     * @param  [int] $priority2
     * @return [int]
     */
    public function compare($priority1, $priority2)
    {
        if ($priority1 === $priority2) {
            return 0;
        }

        return $priority1 > $priority2 ? -1 : 1;
    }

    public function serialize()
    {
        return serialize($this->toArray());
    }

    public function unserialize($serializedData)
    {
        $objects = unserialize($serializedData);

        foreach ($objects as $node) {
            if (
                property_exists($node, 'data') &&
                property_exists($node, 'priority')
            ) {
                $this->insert($node->data, $node->priority);
            }
        }
    }
}
