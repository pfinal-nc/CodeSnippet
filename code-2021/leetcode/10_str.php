<?php

/**
 * @author pfinal南丞
 * @date 2021年07月07日 下午1:34
 */
class Solution
{

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse($x)
    {
        $max = pow(2, 31);
        $s   = intval(strrev(abs($x)));
        return $x >= 0 ? ($s + 1 > $max ? 0 : $s) : ($s > $max ? 0 : '-' . $s);
    }
}
$obj = new Solution();
$x = -120;
$result =$obj->reverse($x);
var_dump($result);