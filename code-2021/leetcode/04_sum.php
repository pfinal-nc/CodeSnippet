<?php
/**
 * @author pfinal南丞
 * @date 2021年07月05日 下午5:11
 */

class Solution
{
    function twoSum($nums, $target)
    {
        $len = count($nums);
        $map = [];
        for ($i = 0; $i < $len; $i++) {
            $sub = $target - $nums[$i];
            if ($i == 0) {
                $map[$nums[0]] == 0;
                continue;
            }
            if (isset($map[$sub])) {
                return [$map[$sub], $i];
            } else {
                $map[$nums[$i]] = $i;
            }
        }
    }
}


$obj = new Solution();
$num = [1, 3, 4, 8, 1];
$arr = $obj->twoSum($num, 7);
print_r($arr);