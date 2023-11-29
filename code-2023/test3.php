<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/29
 * Email: <lampxiezi@163.com>
 */

/** 确保这个函数只能运行在 shell 中 **/
if (!str_starts_with(php_sapi_name(), "cli")) {
    die("This script can only be run in CLI mode.\n");
}
/** 关闭最大执行时间限制 */
set_time_limit(0);
$pid  = posix_getpid();  // 获取主进程ID
$user = posix_getlogin(); // 获取用户名
echo <<<eod
USAGE: [command | expression]
input php code to execute by fork a new process
input quit to exit
        Shell Executor version 1.0.0 by laruence
eod;
while (true) {
    $prompt = PHP_EOL . "{$user}$";
    $input  = readline($prompt);
    readline_add_history($prompt);
    if ($input == 'quit') {
        break;
    }
    process_execute($input . ';');
}
exit(0);
function process_execute($input)
{
    $pid = pcntl_fork(); // 创建子进程
    if ($pid==0) {
        $pid = posix_getpid();
        echo "* Process {$pid} was created, and Executed:\n\n";
        eval($input); //解析命令
        exit;
    }else{
        $pid = pcntl_wait($status, WUNTRACED); //取得子进程结束状态
        if (pcntl_wifexited($status)) {
            echo "\n\n* Sub process: {$pid} exited with {$status}";
        }
    }
}