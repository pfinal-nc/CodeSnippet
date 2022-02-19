<?php
/**
 * @author pfinal南丞
 * @date 2021年10月18日 下午5:11
 */

/**
 *
 * pcntl_wait      等待或返回fork的子进程状态（任意）  等同 pcntl_waitpid(-1, $status, 0)    都是等待任意子进程
 * pcntl_wtermsig  返回导致子进程中断的信号
 *
 */

echo "Master process id = " . posix_getpid() . PHP_EOL;

$childs = []; // 定义一个全局的子进程收集数组

function fork()
{
    global $childs;
    $pid = pcntl_fork();//fork 一个子进程
    switch ($pid) {
        case -1:
            die('Create failed');
            break;
        case 0:
            echo "Child process id = " . posix_getpid() . PHP_EOL;
            while (true) { //死循环  执行任务
                sleep(5);
            }
            break;
        default:
            $childs[$pid] = $pid; // 主进程 记录子进程的进程 id
            break;
    }

    $count = 3;//fork 3个子进程
    for ($i = 0; $i < $count; $i++) {
        fork();
    }

    while (count($childs)) {
        // 监控
        if (($exit_id = pcntl_wait($status)) > 0) {
            echo "CHild({$exit_id}) exited.\n";
            echo "中断子进程的信号值是 " . pcntl_wtermsig($status) . PHP_EOL;//输出中断的信号量
            unset($childs[$exit_id]);
        }
        if (count($childs) < 3) {
            fork();
        }
    }
    echo "Done\n";
}