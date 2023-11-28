<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/28
 * Email: <lampxiezi@163.com>
 */
include './Scheduler.php';
function task1(): Generator
{
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield;
    }
}

function task2(): Generator
{
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        yield;
    }
}

$scheduler = new Scheduler();
$scheduler->newTask(task1());
$scheduler->newTask(task2());

$scheduler->run();