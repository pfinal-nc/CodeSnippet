<?php
/**
 * @author pfinal南丞
 * @date 2021年07月12日 上午11:34
 */

function false_yield_func1()
{
    $arr = [1, 2, 3];
    echo 'run to code line:' . __LINE__ . PHP_EOL;
    return 4;
}

function yield_func1()
{
    $arr = [1, 2, 3];
    echo 'run to code line: ' . __LINE__ . PHP_EOL;
    yield;
    echo 'run to code line: ' . __LINE__ . PHP_EOL;
    return 4;
}

$gen = false_yield_func1();
echo 'false_yield_func1 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

$gen = yield_func1();
echo 'yield_func1 is PHP Generator:';
var_export($gen instanceof Generator);
echo PHP_EOL;

function yield_func2($is = false)
{
    $re = 0;
    try {
        echo 'run to code line:' . __LINE__ . PHP_EOL;
        $re = yield 'exception';
        echo 'run to code line:' . __FILE__ . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo 'run to code line:' . __LINE__ . PHP_EOL;
    echo 're :' . $re . PHP_EOL;
    return '32';
}

$gen = yield_func2(false);
echo 'yield_func2 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func3($is = false)
{
    $re  = 1;
    $arr = [1, 2, 3];
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    if ($re) {
        $re = yield;
    }
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    return $re;
}

$gen = yield_func3(false);
var_export($gen);
echo 'yield_func3 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func4()
{
    $arr = [1, 2, 3];
    if (false) {
        yield;
    }
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    return 44;
}

$gen = yield_func4();
var_dump($gen);
echo 'yield_func4 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func5()
{
    $arr = [1, 2, 3];
    $arr = array('aa', 'bb', 'cc');
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    yield yield_func1();
    echo 'run to code line: ' . __LINE__ . PHP_EOL;
    return null;
}

$gen = yield_func5();
echo 'yield_func5 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func6()
{
    $arr = [1, 2, 3];
    $gen = yield_func1();
    if ($gen instanceof Generator) {
        $gen->send(yield);
    }
    return null;
}

$gen = yield_func6();
echo 'yield_func6 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;


function yield_func7()
{
    $arr = ['a', 'c', 'd'];
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    yield $arr[1];
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    return 'dd';
}

$gen = yield_func7();
var_dump($gen->current());
echo 'yield_func7 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func8()
{
    $arr = ['a', 'b', 'c'];
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    yield from $arr;
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    return null;
}

$gen = yield_func8();
//var_dump($gen->key());
//var_dump($gen->current());
//$gen->next();
//var_dump($gen->current());
echo 'yield_func8 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func9()
{
    $arr = ['a', 'b', 'c'];
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    $re = yield yield_func1();
    echo 'get yield return :';
    var_export($re);
    echo PHP_EOL;
}

$gen = yield_func9();
echo 'yield_func9 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;
var_dump($gen->current());

echo '====================================' . PHP_EOL;
function yield_func10()
{
    yield 2;
    yield 'key' => 'value';
    yield 7 => 'cc';
    yield 5;
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    return 'yield return 10';
}

$gen = yield_func10();
echo 'yield_func10 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;
var_dump($gen->current());
$gen->next();
var_dump($gen->current());
var_dump($gen->key());

function yield_func12()
{
    $result = [];
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    $result[] = yield 12;
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    $result[] = yield;
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    $result[] = yield;
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
    return $result;
}

echo '====================================' . PHP_EOL;
$gen = yield_func12();
echo 'yield_func12 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;

function yield_func13()
{
    try {
        echo 'run to code line:' . __FILE__ . PHP_EOL;
        $re = yield 'exception';
        echo 'run to code line:' . __FILE__ . PHP_EOL;
    } catch (\Exception $e) {
        echo 'exception 1:' . $e->getMessage() . PHP_EOL;
    }

    echo 're : ' . $re . PHP_EOL;
    return '32';
}

echo '====================================' . PHP_EOL;
$gen = yield_func13();
echo 'yield_func13 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;
var_dump($gen->current());
$gen->next();
var_dump($gen->current());

function yield_func14()
{
    echo 'run to code line:' . __FILE__ . PHP_EOL;
    yield 2 => 'aa';
    echo 'run to code line: ' . __FILE__ . PHP_EOL;
}

$gen = yield_func14();
echo 'yield_func14 is PHP Generator :';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;
var_dump($gen->current());
$gen->next();
var_dump($gen->current());

class YieldClass1
{
    public function yield_method1()
    {
        echo 'run to code line: ' . __FILE__ . PHP_EOL;
        yield;
        echo 'run to code line: ' . __FILE__ . PHP_EOL;
    }

    static public function yield_method2()
    {
        echo 'run to code line: ' . __FILE__ . PHP_EOL;
        yield;
        echo 'run to code line: ' . __FILE__ . PHP_EOL;
    }
}

echo '=========================================' . PHP_EOL;
$obj = new YieldClass1();
$gen = $obj->yield_method1();
echo 'YiekdClass1->yield_method1 is PHP Generator:';
var_export($gen instanceof Generator);
echo PHP_EOL . PHP_EOL;
var_export($gen->current());
echo PHP_EOL;

echo '=========================================' . PHP_EOL;

# Generator 对象方法
# Generator::current  返回当前产生的值
# Generator::key      返回当前产生的键
# Generator::next     生成器继续执行
# Generator::rewind   重置迭代器
# Generator::send     向生成器中传入一个值
# Generator::throw    向生成器中抛入一个异常
# Generator::valid    检查迭代器是否被关闭
# Generator::__wakeup 序列化回调
# Generator::getReturn Get the return value of a generator















