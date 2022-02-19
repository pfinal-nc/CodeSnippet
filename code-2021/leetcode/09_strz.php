<?php

/**
 * @author pfinal南丞
 * @date 2021年07月06日 下午7:40
 */
class Solution
{

    /**
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows)
    {
        $s_len = strlen($s);
        if ($s_len <= $numRows || $numRows <= 1) {
            return $s;
        }
// 使用数组来保存数据
        $arr = [];
        // 数组的键名，表示每一行，从1开始
        $key = 1;
        // Z形开始行数一直递增，等于最大行数后递减，然后等于最小行数又回归递增
        $add = true;
        for ($i = 0; $i < $s_len; $i++) {
            $arr[$key][] = $s[$i];
            if ($key == $numRows) {
                $add = false;
            } elseif ($key == 1) {
                $add = true;
            }
            if ($add) {
                ++ $key;
            } else {
                -- $key;
            }
        }
        $str = '';
        for ($j = 1; $j <= $numRows; $j ++) {
            $str .= implode('', $arr[$j]);
        }
        return $str;
    }
}

$obj = new Solution();
$str = "ABCD";

$new_str = $obj->convert($str, 2);
var_dump($new_str);
exit();