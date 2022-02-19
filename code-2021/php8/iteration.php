<?php
/**
 * @author pfinal南丞
 * @date 2021年07月09日 上午11:55
 */

//class SelfIterator implements Iterator
//{
//    private $position = 0;
//    private $arr = [
//        "firstelement",
//        "secondelement",
//        "lastelement"
//    ];
//
//    public function __construct()
//    {
//        $this->position = 0;
//    }
//
//    function rewind()
//    {
//        var_dump(__METHOD__);
//        $this->position = 0;
//    }
//
//    function current()
//    {
//        var_dump(__METHOD__);
//        return $this->array[$this->position];
//    }
//
//    function key()
//    {
//        var_dump(__METHOD__);
//        return $this->position;
//    }
//
//    function next()
//    {
//        var_dump(__METHOD__);
//        ++$this->position;
//    }
//
//    function valid()
//    {
//        var_dump(__METHOD__);
//        return isset($this->array[$this->position]);
//    }
//}
//$it = new SelfIterator;
//
//foreach($it as $key => $value) {
//    var_dump($key, $value);
//    echo "\n";
//}

# 普通 斐波那契数列
//$arr[0] = 1;
//$arr[1] = 1;
//for ($i = 2; $i < 100; $i++) {
//    $arr[$i] = $arr[$i - 1] + $arr[$i - 2];
//}
//echo join(",", $arr);
# 迭代器实现 斐波那契数列
//class Fb implements Iterator
//{
//    protected int $len = 0;
//    protected int $pre = 1;
//    protected int $curr = 1;
//    protected int $count = 0;
//
//    public function __construct(int $len)
//    {
//        $this->len = $len;
//    }
//
//    public function valid(): bool
//    {
//        return $this->count < $this->len;
//    }
//
//    public function next()
//    {
//        $tmp        = $this->curr;
//        $this->curr += $this->pre;
//        $this->pre  = $tmp;
//        $this->count++;
//    }
//
//    public function current(): int
//    {
//        return $this->curr;
//    }
//
//    public function rewind()
//    {
//        $this->pre  = 1;
//        $this->curr = 1;
//    }
//
//    public function key()
//    {
//        // TODO: Implement key() method.
//    }
//}
//
//foreach ((new Fb(40)) as $value) {
//    echo $value . "\n";
//}

# 生成器 实现 斐波那契数列
function Fb(int $len)
{
    $pre   = 1;
    $curr  = 1;
    $count = 1;
    while ($count <= $len) {
        yield $curr;
        $tmp  = $curr;
        $curr += $pre;
        $pre  = $tmp;
        $count++;
    }
}

foreach (Fb(40) as $value) {
    echo $value . "\n";
}