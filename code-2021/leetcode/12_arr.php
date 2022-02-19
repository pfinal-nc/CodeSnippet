<?php
/**
 * @author pfinal南丞
 * @date 2021年07月08日 上午10:47
 */

class Solution
{
    function maxArea($height)
    {
        $l   = 0;   //指针1
        $r   = sizeof($height) - 1;   //指针2
        $max = 0; //最大面积
        while ($l < $r) {
            $tmp = ($r - $l) * min($height[$l], $height[$r]);
            $max = $tmp > $max ? $tmp : $max;   //更新最大面积
            if ($height[$l] > $height[$r]) //移动指针
                $r--;
            else
                $l++;
        }
        return $max;    //返回最大面积
    }
}

$obj    = new Solution();
$height = [1, 8, 6, 2, 5, 4, 8, 3, 7];
$obj->maxArea($height);