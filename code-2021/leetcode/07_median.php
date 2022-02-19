<?php

# 中位数
class Solution
{

    function findMedianSortedArrays($nums1, $nums2)
    {
        $mid = (count($nums1) + count($nums2)) / 2;
        if (is_float($mid)) {
            return self::find($nums1, $nums2, (int) ceil($mid));
        }
        return (self::find($nums1, $nums2, $mid) + self::find($nums1, $nums2, 1)) / 2;
    }
    static function find(&$nums1, &$nums2, $seq)
    {
        $c1 = count($nums1);
        $c2 = count($nums2);
        if ($c1 > $c2) {
            [$nums1, $nums2, $c1, $c2] = [$nums2, $nums1, $c2, $c1];
        }
        if (0 === $c1) {
            if ($seq > 1) {
                $nums2 = array_slice($nums2, 0, 1 - $seq);
            }

            return array_pop($nums2);
        }

        if (1 === $seq) {
            return end($nums1) > end($nums2) ? array_pop($nums1) : array_pop($nums2);
        }
        $offset1 = $seq / 2;
        $offset2 = (int) ceil($offset1);

        $offset1 = (int) $offset1;
        if ($offset1 > $c1) {
            $offset2 += $offset1 - $c1;
            $offset1 = $c1;
        }

        $index1 = $c1 - $offset1;
        $index2 = $c2 - $offset2;

        if ($nums1[$index1] >= $nums2[$index2]) {
            $seq -= $offset1;
            $nums1 = 0 === $index1 ? [] : array_slice($nums1, 0, $index1);
        } else {
            $seq -= $offset2;
            $nums2 = array_slice($nums2, 0, $index2);
        }

        return self::find($nums1, $nums2, $seq);
    }
}

$obj = new Solution();

$nums1 = [1, 2, 3, 5];
$nums2 = [3, 4];
$key = $obj->findMedianSortedArrays($nums1, $nums2);
var_dump($key);
