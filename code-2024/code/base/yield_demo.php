<?php
/**
 * Author: PFinal南丞
 * Date: 2024/6/13
 * Email: <lampxiezi@163.com>
 */

function xrange($start, $end, $step = 1)
{
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

//
//foreach (xrange(1, 10) as $i) {
//    echo $i . PHP_EOL;
//}
// 上面这个 xrange() 函数提供了和PHP的内建函数 range() 一样的功能, 但是不同的是 range() 函数返回的是一个包含值从1到100万0的数组,而xrange() 函数返回的是
// 依次输出这些值的 一个迭代器, 而不会真正以数组形式返回.
// 这种方法的优点是显而易见的,它可以让你在处理大数据集合的时候不用一次性的加载到内存中,甚至你可以处理无限大的数据流
// 当然,也可以不同通过生成器来实现这个功能,而是可以通过继承 Iterator接口实现, 但通过使用生成器实现起来会更方便, 不用再去实现 iterator 接口中的5个方法了.

# 生成器为可中断的函数
# 要从生成起认识协程, 理解它内部是如何工作时非常重要的; 生成器是一种可中断的函数, 在它里面的 yield 构成了中断点.

$range = xrange(1, 1000000);
var_dump($range);
var_dump($range instanceof Iterator);

// 这也解释了为什么 xrange 叫做迭代生成器， 因为它返回一个迭代器,而这个迭代器实现了 Ierator 接口.
// 调用迭代器的方法依次,其中的代码运行一次,例如,如果你调用 $range->rewind(),那么xrange() 里的 代码就会运行到第一次出现 yield的地方. 而函数内传递给 yield 语句的返回值可以通过
// $range->current() 方法获取.
// 为了继续执行生成器中yield后的代码, 你就需要调用$range->next()方法. 这将再次启动生成器, 直到下一次yield语句出现. 因此,连续调用next()和current()方法, 你就能从生成器里获得所有的值, 直到再没有yield语句出现.
// 对 xrange() 来说, 这种情况出现在 $i 超过 $end 时, 在这种情况下, 控制流将到达函数的终点, 因此将不执行任何代码.一旦这种情况发生, valid() 方法将返回假,迭代结束

## 协程
# 协程的支持是在迭代生成器的基础上, 增加了可以回送数据给生成器的过功能(调用者发送数据给被调用的生成器函数), 这就把生成器到调用者的单向通信转变为两者之间的双向通信
# 传递数据的功能是通过迭代器的 send() 方法实现的,下面的 logger() 协程是这种通信如何运行的例子:

function logger($fileName)
{
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        fwrite($fileHandle, (yield) . PHP_EOL);
    }
}

$logger = logger(__DIR__ . '/log');
$logger->send('Hello');
$logger->send('World');

// 这儿 yield 没有座位一个语句来使用, 而是用作一个表达式, 即它 能被 演化成一个值, 这个值就是调用者传递给 send()方法的值, 在这个例子里, yield 表达式将首先被"Foo"替代写入Log, 然后被"Bar"替代写入Log.

function gen()
{
    $ret = (yield 'yield1');
    var_dump($ret);
    $ret = (yield 'yield2');
    var_dump($ret);
}
$gen = gen();
var_dump($gen->current());
var_dump($gen->send('ret1'));
var_dump($gen->send('ret2'));
var_dump($gen->send('ret2'));

// 1. yield 表达式两边的括号在PHP7以前不是可选的,也就是说在PHP5.5和PHP5.6中圆括号是必须的
// 2. 可能已经注意到调用 current() 之前 没有调用 rewind() 这是因为生成迭代对象的时候已经隐含地执行了 rewind 操作

## 多任务协作
# 多任务协作这个术语中的 协作很好的说明了如何进行这种切换的: 它要求当前正在运行的任务自动把控制传回给调度器.
# 这样就可以运行其他任务了,这与抢占多任务相反, 抢占多任务是这样的: 调度器可以中断运行了一段时间的任务,不管它喜欢还是不喜欢.协作多任务
# 在 windows 的早期版本 和macos 中有使用


