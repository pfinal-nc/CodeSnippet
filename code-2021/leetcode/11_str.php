<?php
/**
 * @author pfinal南丞
 * @date 2021年07月08日 上午10:22
 */

class Solution
{
    public function isMatch($s, $p)
    {
//        $p = "/^{$p}$/u";
//        preg_match($p, $s, $ret);
//        if (empty($ret)) {
//            return false;
//        }
//        return true;
        $m       = strlen($s);
        $n       = strlen($p);
        $f       = array_fill(0, $m + 1, array_fill(0, $n + 1, false));
        $f[0][0] = true;
        for ($k = 2; $k <= $n; $k++) {
            $f[0][$k] = $f[0][$k - 2] && $p[$k - 1] == '*';
        }
        for ($i = 1; $i <= $m; $i++) {
            for ($j = 1; $j <= $n; $j++) {
                if ($s[$i - 1] == $p[$j - 1] || $p[$j - 1] == '.') {
                    $f[$i][$j] = $f[$i - 1][$j - 1];
                }
                if($p[$j - 1] == '*'){
                    $f[$i][$j] = $f[$i][$j - 2] ||
                        $f[$i - 1][$j] && ($s[$i - 1] == $p[$j - 2] || $p[$j - 2] == '.');
                }
            }
        }
        return $f[$m][$n];
    }
}

$obj = new Solution();
$s   = "aa";
$p   = "a*";
var_dump($obj->isMatch($s, $p));