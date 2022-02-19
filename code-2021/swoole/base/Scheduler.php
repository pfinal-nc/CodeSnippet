<?php
/**
 * @author pfinal南丞
 * @date 2021年10月18日 下午3:04
 */
require_once './task_php.php';

class Scheduler
{
    protected $queue;

    public function __construct()
    {
        $this->queue = new SplQueue(); //FIFO 队列
    }

    public function enqueue(Task $task)
    {
        $this->queue->enqueue($task);
    }

    public function run()
    {
        while (!$this->queue->isEmpty()) {
            $task = $this->queue->dequeue();
            $task->run();
            if (!$task->finished()) {
                $this->queue->enqueue($task);
            }
        }
    }
}

$scheduler = new Scheduler();

$task1 = new Task(call_user_func(function() {
    for ($i = 0; $i < 3; $i++) {
        print "task1: " . $i . "\n";
        yield sleep(1); //挂起IO操作
    }
}));

$task2 = new Task(call_user_func(function() {
    for ($i = 0; $i < 6; $i++) {
        print "task2: " . $i . "\n";
        yield sleep(1); //挂起IO操作
    }
}));

$scheduler->enqueue($task1);
$scheduler->enqueue($task2);
$startTime = microtime(true);
$scheduler->run();
print "用时: ".(microtime(true) - $startTime).PHP_EOL;

//异步sleep
