<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/28
 * Email: <lampxiezi@163.com>
 */

/** 确保这个函数只能运行在 shell 中 **/
if (!str_starts_with(php_sapi_name(), "cli")) {
    die("This script can only be run in CLI mode.\n");
}
/** 关闭最大执行时间限制 */
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
const MAX_SELLP_TIME = 120;
$hostname = '';
$username = '';
$password = '';
$connect  = mysqli_connect($hostname, $username, $password);
$result   = mysqli_query($connect, "SHOW PROCESSLIST");
while ($process = mysqli_fetch_assoc($result)) {
    // 检查是否有超过 120 秒的睡眠进程
    if ($process["Command"] == "Sleep" && $process["Time"] > MAX_SELLP_TIME) {
        mysqli_query($connect, "kill " . $process["Id"]);
        echo "Killed sleeping process: " . $process["Id"] . "\n";
    }

}
mysqli_close($connect);