<?php

// 数组排序加对撞指针

class Solution
{
    function twoSum($num, $target)
    {
        $map = []; //hash查找表
        foreach ($num as $key => $item) {
            $map[$item][] = $key;
        }
        foreach ($num as $item) {
            $b = $target - $item;
            if (isset($map[$b]) && $item != $b) {
                return [$map[$item][0], $map[$b][0]]; // 找到返回
            } else if (isset($map[$b]) && $item == $b) {
                if (sizeof($map[$item]) > 1) {
                    return [$map[$item][0], $map[$item][1]];
                }
            }
        }
    }
}

$obj = new Solution();
$num = [1, 3, 4, 8,1];
$arr = $obj->twoSum($num, 7);
echo '<pre>';
print_r($arr);
exit();