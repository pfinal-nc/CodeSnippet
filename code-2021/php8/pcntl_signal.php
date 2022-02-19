<?php
/**
 * @author pfinal南丞
 * @date 2021年06月08日 上午11:50
 */
declare(ticks = 1);

pcntl_signal(SIGINT,function(){
    echo "你按了Ctrl+C".PHP_EOL;
});
while(1){
    sleep(1);//死循环运行低级语句
}