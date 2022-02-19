<?php
/**
 * @author pfinal南丞
 * @date 2021年10月18日 下午2:59
 */

class Task
{
    protected $generator;
    protected $run = false;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function run()
    {
        if ($this->run) { //判断是否第一次 run 第一次用next直接会跑到第二个 yield
            $this->generator->next();
        } else {
            $this->generator->current();
        }
        $this->run = true;
    }

    public function finished()
    {
        return !$this->generator->valid();
    }
}

