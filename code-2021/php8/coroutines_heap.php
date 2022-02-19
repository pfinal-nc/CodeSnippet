<?php
/**
 * @author pfinal南丞
 * @date 2021年07月13日 上午11:49
 */

class Task
{
    protected $taskId;
    protected $coroutine;
    protected $sendValue = null;
    protected $beforeFirstYield = true;

    public function __construct($taskId, Generator $coroutine)
    {
        $this->taskId    = $taskId;
        $this->coroutine = stackedCoroutine($coroutine);
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setSendValue($sendValue)
    {
        $this->sendValue = $sendValue;
    }

    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            $retval          = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $retval;
        }
    }

    public function isFinished()
    {
        return !$this->coroutine->valid();
    }
}


# 调度器
class Scheduler
{
    protected $maxTaskId = 0;
    protected $taskMap = [];
    protected $taskQueue;

    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }

    public function newTask(Generator $coroutine)
    {
        $tid                 = ++$this->maxTaskId;
        $task                = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
    }

    public function schedule(Task $task)
    {
        $this->taskQueue->enqueue($task);
    }

    public function run()
    {
        while (!$this->taskQueue->isEmpty()) {
            $task = $this->taskQueue->dequeue();
            $task->run();
            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }
}

class CoroutineReturnValue
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
function retval($value) {
    return new CoroutineReturnValue($value);
}

# 协程堆栈
function stackedCoroutine(Generator $gen)
{
    $stack = new SplStack;
    for (; ;) {
        $value = $gen->current();
        if ($value instanceof Generator) {
            $stack->push($gen);
            $gen = $value;
            continue;
        }
        $isReturnValue = $value instanceof CoroutineReturnValue;
        if (!$gen->valid() || $isReturnValue) {
            if ($stack->isEmpty()) {
                return;
            }
            $gen = $stack->pop();
            $gen->send($isReturnValue ? $value->getValue() : null);
            continue;
        }
        $gen->send(yield $gen->key() => $value);
    }
}

function echoTimes($msg, $max)
{
    for ($i = 1; $i <= $max; ++$i) {
        echo "$msg iteration $i\n";
        yield;
    }
    yield retval("");
}

function task()
{
    yield from echoTimes('bar', 5);
}

$scheduler = new Scheduler;
$scheduler->newTask(task());
$scheduler->run();