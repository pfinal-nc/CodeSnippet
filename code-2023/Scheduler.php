<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/28
 * Email: <lampxiezi@163.com>
 */
include './task.php';

// 调度器
class Scheduler
{
    protected int $maxTaskId = 0;
    protected array $taskList = [];
    protected SplQueue $taskQueue;

    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }

    public function newTask(Generator $coroutine): int
    {
        $tid                  = ++$this->maxTaskId;
        $task                 = new Task($tid, $coroutine);
        $this->taskList[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }

    public function schedule(Task $task): void
    {
        $this->taskQueue->enqueue($task);
    }

    public function run(): void
    {
        while (!$this->taskQueue->isEmpty()) {
            $task = $this->taskQueue->dequeue();
            $task->run();
            if ($task->isFinished()) {
                unset($this->taskList[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }
}
