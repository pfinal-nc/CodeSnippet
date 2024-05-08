<?php
/**
 * Author: PFinal南丞
 * Date: 2024/5/8
 * Email: <lampxiezi@163.com>
 */

// 定义一个输出接口
interface OutputInterface
{
    public function load();
}

// 定义一个名为 HelloWorld 的类  他依赖 OutputInterface
class HelloWorld
{
    private $output;
    // 使用依赖注入, 在构造函数中接受输出接口的实例
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }
    public function sayHello()
    {
        $this->output->load();
    }
}

// 实现输出接口的一个具体类
class EchoOutput implements OutputInterface
{
    public function load()
    {
        echo 'Hello World!';
    }
}

// 创建 helloword 类的一个实例
$obj = new HelloWorld(new EchoOutput());
$obj->sayHello();