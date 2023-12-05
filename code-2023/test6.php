<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/5
 * Email: <lampxiezi@163.com>
 */

//class One
//{
//    private Closure $closure;
//    public function __construct(Closure $closure)
//    {
//        $this->closure = $closure;
//    }
//    public function doSomething()
//    {
//        if(1>2) {
//            // 用的时候在实例化
//            $instance = $this->closure();
//            $instance->do();
//        }
//    }
//}
//
//$instance = new One(function () {
//    return new Two();
//});
//
//$instance->doSomething();

// 关联数组做 map
//class One
//{
//    private array $map = [
//        'a' => 'namespace\A', // 带上命名空间，因为变量是动态的
//        'b' => 'namespace\B',
//        'c' => 'namespace\C'
//    ];
//    public function doSomething()
//    {
//        $instance = new $this->map[$strategy];// $strategy是'a'或'b'或'c'
//        $instance->doSomething(...);
//    }
//}
