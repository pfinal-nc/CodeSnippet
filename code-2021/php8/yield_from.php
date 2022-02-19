<?php
/**
 * @author pfinal南丞
 * @date 2021年07月12日 下午5:07
 */

//function yield_from_func()
//{
//    (yield from [1, 2, 3, 4]);
//}
//
//foreach (yield_from_func() as $value) {
//    echo 'value is :' . $value . PHP_EOL;
//}

# `yield form` 能把个数组(也可以是迭代器)一个个遍历并送出来
# `yield from` 右侧是生成器时， 调用`next`，`current` 也能将生成器内的元素一个个送出。

//function yield_func()
//{
//    yield 1;
//    yield 2;
//    yield 3;
//}
//
//function yield_from_func2()
//{
//    (yield from yield_func());
//}
//
//$gen = yield_from_func2();
//echo 'value is :' . $gen->current() . PHP_EOL;
//
//$gen->next();
//echo 'value is : ' . $gen->current() . PHP_EOL;
//
//$gen->next();
//echo 'value is : ' . $gen->current() . PHP_EOL;
//$gen->next();

//function yield_func()
//{
//    echo 'run yield_func' . PHP_EOL;
//    $get = (yield 12);
//    echo $get . PHP_EOL;
//    $get2 = (yield 55);
//    echo $get2 . PHP_EOL;
//    return 'a';
//}
//
//function yield_from_func()
//{
//    echo 'run yield_from_func' . PHP_EOL;
//    return (yield from yield_func());
//}
//
//$gen2 = yield_from_func();
//$re   = $gen2->current();
//$gen2->send(100);
//$re2 = $gen2->current();
//echo 'get re2:' . $re2 . PHP_EOL;
//$gen2->send('world');
//$re3 = $gen2->getReturn();
//echo 'get return:' . $re3 . PHP_EOL;

//function yield_from_func3()
//{
//    yield from 'test';
//}
//
//echo 'eg: No.5' . PHP_EOL;
//$gen = yield_from_func3();
//echo 'call yield_from_func2 current' . PHP_EOL;

function yield_func20()
{
    $arr = [];
    echo 'run to function ' . __FUNCTION__ . ' line: ' . __LINE__ . PHP_EOL;
    $arr[] = yield 2;
    $arr[] = yield 'key' => 'value';
    $arr[] = yield 7 => 'cc';
    $arr[] = yield 5;
    echo 'run to function ' . __FUNCTION__ . ' line: ' . __LINE__ . ', arr re: ';
    var_export($arr);
    echo PHP_EOL;
}