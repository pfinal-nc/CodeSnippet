<?php
/**
 * Author: PFinal南丞
 * Date: 2024/4/23
 * Email: <lampxiezi@163.com>
 */

//class Foo
//{
//}

//$join = function (...$string) {
//    return implode('-', $string);
//};

// bindTo 为类的实力添加 join 功能

//$foo = new Foo();
//$bindFoo = $join->bindTo($foo,Foo::class);
//echo $bindFoo('a','b','c').PHP_EOL;

//$foo = new Foo();
//echo $join->call($foo,'a','b','c').PHP_EOL;
//
//$bindClass = \Closure::bind($join,null,Foo::class);
//echo $bindClass('a','b','c').PHP_EOL;

# 通过匿名函数扩展类的功能

trait Macroable
{
    // 保存要扩展的功能
    protected static $macros = [];

    // 添加要扩展功能

    public static function macro($name, $macro)
    {
        static::$macros[$name] = $macro;
    }
}

class Foo
{
    use Macroable;

    public static function __callStatic($name, $arguments)
    {
        // 获取匿名函数
        $macro = static::$macros[$name];

        // 绑定到类
        $bindClass = \Closure::bind($macro,null,static::class);

        // 调用并返回到调用结果
        return $bindClass(...$arguments);
    }
}

// 添加 join功能
Foo::macro('join',function (...$string){
    return implode('-',$string);
});

// join 功能及对应的视线已经保存到了 macros 数组中. 接下来是调用 join 方法

echo Foo::join('a','b','c').PHP_EOL;