<?php
/**
 * @author pfinal南丞
 * @date 2021年10月18日 上午11:11
 */

pcntl_signal(SIGALRM, function () {
    echo '这是一个信号.'.PHP_EOL;
});

pcntl_alarm(5);

while(true) {
    pcntl_signal_dispatch();
    sleep(1);
}