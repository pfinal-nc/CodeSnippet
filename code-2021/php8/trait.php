<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午2:49
 */

trait Test {
    abstract public function t(int $input): int;
}

class UseTest
{
    public function t(int $input): int
    {
        return $input;
    }
}

$obj = new UseTest();
var_dump($obj->t(123));