## Laravel Cached Priority Queue

A Priority Queue for the Laravel Framework. Easy to install, use, and store. A nice wrapper for PHP's SplPriorityQueue class.

## Install
```
composer require cheungd/laravel-cached-priority-queue
```

## Configuration

Find the `aliases` array in `config/app.php` and add the following:

```
    'aliases' => [
    	...
    	'CachedPriorityQueue' => DavidCheung\LaravelCachedPriorityQueue\CachedPriorityQueue::class,
    ],
```

## Usage

Initializing and interacting with the queue:

```
use CachedPriorityQueue;

//load the priority queue from cache if key exists
$queue = new CachedPriorityQueue('my_key');

//creates queue: [John, David, Mike, Will]
$queue->insert('Mike', 5);
$queue->insert('Will', 5);
$queue->insert('John', 1);
$queue->insert('David', 1);

//Will retrieve the first item 'John', but remains in queue
//resulting queue: [John, David, Mike, Will]
$item = $queue->peek();

//Will retrieve the first item 'John', and removes from queue
//result queue: [David, Mike, Will]
$item = $queue->remove();

//save in cache with key 'my_key'
$queue->save();

```

Iterator:

```
$queue = new CachedPriorityQueue('my_key');

//[John, David, Mike, Will]
$queue->insert('Mike', 5);
$queue->insert('Will', 5);
$queue->insert('John', 1);
$queue->insert('David', 1)

$object = $queue->toArray();
/**
array:4 [
  0 => {
    "data": "John"
    "priority": 1
  }
  1 => {
    "data": "David"
    "priority": 1
  }
  2 => {
    "data": "Mike"
    "priority": 5
  }
  3 => {
    "data": "Will"
    "priority": 5
  }
]
**/

```

## License

This software is licensed under the [MIT license](http://opensource.org/licenses/MIT)
