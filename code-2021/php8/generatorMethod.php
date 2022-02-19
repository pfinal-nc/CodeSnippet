<?php
/**
 * @author pfinal南丞
 * @date 2021年07月12日 下午3:27
 */

//function yield_func()
//{
//    yield 12;
//    return 'a';
//}
//
//$gen = yield_func();
//# 获取当前
//$re  = $gen->current();
//echo 'Current return ' . $re . PHP_EOL;

//function yield_func()
//{
//    $data = yield 12;
//    echo 'get yield data: ' . $data;
//    return 'a';
//}
//
//$gen = yield_func();
//$re  = $gen->current();
//$gen->send(32);
//echo PHP_EOL;

//function yield_func()
//{
//    echo 'run to code line: ' . __LINE__ . PHP_EOL;
//    yield;
//    echo 'run to code line: ' . __LINE__ . PHP_EOL;
//    return '';
//}
//$gen = yield_func();
//$gen->current();
//echo 'current called' . PHP_EOL;
//$gen->next();

//function yield_func()
//{
//    echo 'run to code line: ' . __LINE__ . PHP_EOL;
//    $result = yield 12;
//    echo 'run to code line: ' . __LINE__ . PHP_EOL;
//}
//
//$gen = yield_func();
//echo 'call yield_func rewind ' . PHP_EOL;
//$gen->rewind();

# Generator::throw

//function yield_func()
//{
//    try {
//        $re = yield 'exception';
//    } catch (\Exception $e) {
//        echo 'catched exception msg: ' . $e->getMessage();
//    }
//}
//
//$gen = yield_func();
//$gen->throw(new \Exception('new yield exception'));

# 通过以上简单的例子可得, throw 就是让 yield 这行代码产生异常， 让外面的 try catch 捕获我们生成的那个异常.

# Generator::valid  检查迭代器是否被关闭

//function yield_func()
//{
//    yield 12;
//    return 'a';
//}
//
//$gen = yield_func();
//$gen->send(1);
//$check = $gen->valid();
//echo 'the generator valid ? ' . intval($check) . PHP_EOL;
# 当生成器运行到 yield 代码段时，用 valid 函数检查，都会返回 true

# Generator::key

//function yield_func()
//{
//    yield 1 => 'abc';
//}
//
//$gen = yield_func();
//echo 'value is :' . $gen->current() . PHP_EOL;
//echo 'key is: ' . $gen->key() . PHP_EOL;
//
//
//


# Generator::__wakeup 序列化回调 生成器 不能被序列化成一个字符串
function yield_func()
{
    yield 1 => 'abc';
    return 32;
}

$gen = yield_func();
$gen->send(0);
echo 'call yield_func return and get: ' . $gen->getReturn() . PHP_EOL;
//try {
//    $ser = serialize($gen);
//} catch (\Exception $e) {
//    print_r($e->getMessage());
//}

