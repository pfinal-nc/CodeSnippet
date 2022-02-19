<?php

// 数组排序加对撞指针

class Solution
{
    function twoSum($num, $target)
    {
        $map = [];
        foreach ($num as $key => $item) {
            $b = $target - $item;
            if (isset($map[$b])) {
                return [$map[$b], $key]; //找到返回
            } else {
                $map[$item] = $key;//放入哈希表
            }
        }
    }
}

$obj = new Solution();
$num = [1, 3, 4, 8, 1];
$arr = $obj->twoSum($num, 7);
print_r($arr);