<?php
/**
 * @author pfinal南丞
 * @date 2021年10月18日 下午3:58
 *
 *  函数
 * pcntl_fork  创建新进程
 * pcntl_waitpid  等待或返回fork的子进程状态
 * posix_getpid   返回当前进程 id
 * posix_getppid 取得父进程 id
 * 注意
 * pcntl_fork 调用一次，返回两个值；子进程得到的是0，父进程得到的子进程 id
 *
 */

echo "Master process id = " . posix_getpid() . PHP_EOL;
$pid = pcntl_fork(); // 创建一个新的进程

switch ($pid) {
    case -1:
        die('Create failed');
        break;
    case 0:
        echo "Child process id " . posix_getpid() . PHP_EOL;
        sleep(2);
        echo "I will exit\n";
        break;
    default:
        if ($exit_id = pcntl_waitpid($pid, $status, WUNTRACED)) {
            // 为了防止主进程挂了 子进程变成孤儿进程 所以在等待子进程执行完成以后
            echo "Child({$exit_id}) exited\n";
        }
        echo "Parent process id = " . posix_getpid() . PHP_EOL;
        break;
}