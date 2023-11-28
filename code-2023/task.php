<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/28
 * Email: <lampxiezi@163.com>
 */

class Task
{
    protected int $taskId;
    protected $coroutine;
    protected string|null $sendValue = null;
    protected bool $beforeFirstYield = true;

    public function __construct($taskId, $coroutine)
    {
        $this->taskId    = $taskId;
        $this->coroutine = $coroutine;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function setSendValue($sendValue): void
    {
        $this->sendValue = $sendValue;
    }

    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            return $this->coroutine->send($this->sendValue);
        }
    }

    public function isFinished()
    {
        return !$this->coroutine->valid();
    }
}