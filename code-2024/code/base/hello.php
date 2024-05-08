<?php
/**
 * Author: PFinal南丞
 * Date: 2024/5/8
 * Email: <lampxiezi@163.com>
 */

# 定义命名空间
namespace hello;

# 定义类
class HelloWorld
{
    public function sayHello()
    {
        echo 'Hello World!';
    }
}

// 自动加载器
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

// 创建 HelloWorld 对象
$obj = new \hello\HelloWorld();
$obj->sayHello();