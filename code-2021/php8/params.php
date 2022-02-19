<?php

/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午2:18
 */
class User
{

    public function paramTest($name, $age)
    {
        var_dump($name . $age."\t");// string(8) ""
    }

    public function paramTest1($name, $age, ...$other)
    {
        var_dump($other);
    }

}

$user = new User();

$user?->paramTest(name: 'PFinal', age: 24);
$user?->paramTest1(name: 'PFinal', age: 24, sex: 1, like: '电脑');