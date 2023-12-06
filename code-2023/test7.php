<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/5
 * Email: <lampxiezi@163.com>
 */

class AsyncPHP
{
    public function curl($url): bool|string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function testAsync(): void
    {
        $url   = 'https://www.baidu.com/?i=';
        $start = microtime(true);
        $i     = 0;
        $pids  = [];
        while ($i < 5) {
            $pids[$i] = pcntl_fork(); //创建子进程
            if ($pids[$i] == 0) { //返回0表示在子进程
                $this->curl($url . $i);; //子进程执行代码
                exit(0);
            }
            $i++;
        }
        // 等待进程关闭
        for ($j = 0; $j < 5; $j++) {
            pcntl_waitpid($pids[$j], $status, WUNTRACED); //等待进程结束
            if (pcntl_wifexited($status)) {
                //子进程完成退出
                echo '第' . $j . '次访问百度，用时:' . microtime(true) - $start . "\n";
            }
        }
        $end = microtime(true);
        echo "\n总用时", $end - $start . "\n";
    }
}

$tester = new AsyncPhp();
$tester->testAsync();