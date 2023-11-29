<?php
/**
 * Author: PFinal南丞
 * Date: 2023/11/29
 * Email: <lampxiezi@163.com>
 */

/**
 * 容器接口
 */
interface ContainerInterface
{
    /**
     * // 增加一个名字
     * @param $name
     */
    public function add($name);

    /**
     * 获取迭代器
     * @return mixed
     */
    public function getIterator(): mixed;
}

/**
 *  姓名容器
 */
class NameContainer implements ContainerInterface
{
    /**
     * @var array
     */
    protected array $nameArray = [];

    /**
     * @param $name
     * @return void
     */
    public function add($name): void
    {
        $this->nameArray[] = $name;
    }

    /**
     * @return NameIterator
     */
    public function getIterator(): NameIterator
    {
        return new NameIterator($this->nameArray);
    }
}

interface IteratorInterface
{
    /**
     * 判断是否还有下一个
     * @return bool
     */
    public function hasNext(): mixed;

    /**
     * 获取下一个
     * @return void
     */
    public function next(): void;
}

class NameIterator implements IteratorInterface
{
    /**
     * @var array
     */
    protected array $nameArray = [];
    /**
     * @var int
     */
    protected int $index = 0;

    /**
     * @param $nameArray
     */
    public function __construct($nameArray)
    {
        $this->nameArray = $nameArray;
    }


    public function hasNext(): bool
    {
        return isset($this->nameArray[$this->index]);
    }

    public function next(): void
    {
        if ($this->hasNext()) {
            echo $this->nameArray[$this->index] . PHP_EOL;
            $this->index++;
        }
    }
}

class Client
{
    public function run(): void
    {
        $nameContainer = new NameContainer();
        $nameContainer->add("张三");
        $nameContainer->add("张二");
        $nameContainer->add("张一");
        $nameIterator = $nameContainer->getIterator();
        while ($nameIterator->hasNext()) {
            $nameIterator->next();
        }
    }
}

$client = new Client();
$client->run();