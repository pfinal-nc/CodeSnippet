<?php

# 中位数
class Solution
{

    function findMedianSortedArrays($nums1, $nums2)
    {
        $new_array = array_merge($nums1, $nums2);
        sort($new_array);
        $count = count($new_array);
        if (!$count) return 0;
        if (!$count == 1) return $new_array[0];
        if ($count % 2 == 1) {
            return $new_array[(($count - 1) / 2)];
        }
        return ($new_array[($count / 2) - 1] + $new_array[($count / 2)]) / 2;
    }
}

$obj = new Solution();

$nums1 = [];
$nums2 = [3, 4];
$key = $obj->findMedianSortedArrays($nums1, $nums2);
var_dump($key);
