<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/28
 * Email: <lampxiezi@163.com>
 */

//function yield_from_func()
//{
//    (yield from array(1, 2, 3, 4));
//}
//
//foreach (yield_from_func() as $value) {
//    echo 'value is:' . $value . PHP_EOL;
//}

function yield_func20()
{
    $arr = [];
    echo 'run to function' . __FUNCTION__ . ' line:' . __LINE__ . PHP_EOL;
    $arr[] = yield 2;
    $arr[] = yield 'key' => 'value';
    $arr[] = yield 7 => 'cc';
    $arr[] = yield 5;
    echo 'run to function ' . __FUNCTION__ . ' line: ' . __LINE__ . ', arr re: ';
    var_export($arr);
    echo PHP_EOL;
}

foreach (yield_func20() as $item) {
    echo 'item is:' . $item . PHP_EOL;
}