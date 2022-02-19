<?php
/**
 * @author pfinal南丞
 * @date 2021年06月08日 上午11:57
 */
echo "安装信号处理器...\n";
pcntl_signal(SIGHUP,  function($signo) {
    echo "信号处理器被调用\n";
});
print_r(posix_getegid()."\n");
echo "为自己生成SIGHUP信号...\n";
posix_kill(posix_getpid(), SIGHUP);
echo "分发...\n";
pcntl_signal_dispatch();
echo "完成\n";