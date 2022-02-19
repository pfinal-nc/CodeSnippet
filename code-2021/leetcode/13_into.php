<?php
/**
 * @author pfinal南丞
 * @date 2021年07月12日 上午11:11
 */

class Solution
{

//    function intToRoman($num)
//    {
//        $arr = ['I', 'V', 'X', 'L', 'C', 'D', 'M'];
//        $s   = (string)$num;
//        $l   = strlen($s);
//        $a   = str_split($s);
//        $r   = '';
//        foreach ($a as $v) {
//            $v = (int)$v;
//            $k = $l * 2;
//            switch ($v) {
//                case 5:
//                    $r .= $arr[$k - 1];
//                    break;
//                case 4:
//                    $r .= $arr[$k - 2] . $arr[$k - 1];
//                    break;
//                case 9:
//                    $r .= $arr[$k - 2] . $arr[$k];
//                    break;
//                default:
//                    if ($v > 5) {
//                        $r .= $arr[$k - 1];
//                        $v -= 5;
//                    }
//                    for ($i = 0; $i < $v; $i++) {
//                        $r .= $arr[$k - 2];
//                    }
//            }
//            $l--;
//        }
//        return $r;
//    }

    function intToRoman($num)
    {
        $model = [1000 => "M", 900 => "CM", 500 => "D", 400 => "CD", 100 => "C", 90 => "XC", 50 => "L", 40 => "XL", 10 => "X", 9 => "IX", 5 => "V", 4 => "IV", 1 => "I"];
        $res   = '';
        foreach ($model as $key => $value) {
            while ($num >= $key) {
                $num -= $key;
                $res .= $value;
            }
        }
        return $res;
    }

}