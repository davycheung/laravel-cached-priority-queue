## Laravel Cached Priority Queue

A Priority Queue for the Laravel Framework. Easy to install, use, and store. 

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

```
use CachedPriorityQueue;

//load the priority queue from cache if key exists
$queue = new CachedPriorityQueue('my_key');

//insert value with priority 5
$queue->insert('Mike', 5);

//insert value with priority 5
$queue->insert('Will', 5);

//insert value with priority 1
$queue->insert('John', 1);

//insert value with priority 1
$queue->insert('David', 1);

//Will retrieve the first item 'John', but remains in queue
$item = $queue->peek();

//Will retrieve the first item 'John', and removes from queue
$item = $queue->remove();

//save in cache with key 'my_key'
$queue->save();

```


## License

This software is licensed under the [MIT license](http://opensource.org/licenses/MIT)
