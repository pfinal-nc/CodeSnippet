<?php

// 数组排序加对撞指针

class Solution
{
    function twoSum($num, $target)
    {
        asort($num); //排序 保留键值
        $arr1 = $num;
        sort($num); // 排序 键值不保留 用于循环
        $arr2 = $num;
        $arr3 = []; // 用户建立arr1 和 arr2键值对应关系
        $i    = 0;
        foreach ($arr1 as $key => $val) {
            $arr3[$i] = $key;
            $i++;
        }
        $l = 0;
        $r = sizeof($num) - 1;
        while ($l < $r) {
            $sum = $arr2[$l] + $arr2[$r];
            if ($sum == $target) {
                return [$arr3[$l], $arr3[$r]]; // 找到结果返回
            } else if ($sum > $target) {
                $r--; //移动右指针
            } else {
                $l++;// 移动左指针
            }
        }
    }
}

$obj = new Solution();
$num = [1, 3, 4, 8];
$arr = $obj->twoSum($num, 7);
echo '<pre>';
print_r($arr);
exit();