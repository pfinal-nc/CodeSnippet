<?php

class Solution
{

    public function longestPalindrome($s)
    {
        $n = strlen($s);
        if ($n <= 1) return $s;
        $maxStart = $maxLen = $maxEnd = 0;// 最长回文串起点
        $dp       = array_fill(0, $n, array_fill(0, $n, false));
        for ($i = 0; $i < $n; $i++) {
            $dp[$i][$i] = true;
        }
        for ($r = 0; $r < $n; ++$r) {
            for ($l = 0; $l < $r; ++$l) {
                if ($s[$l] == $s[$r] && ($dp[$l + 1][$r - 1] || $r - $l < 2)) {
                    $dp[$l][$r] = true;
                    if ($r - $l + 1 > $maxLen) {
                        $maxLen   = $r - $l + 1;
                        $maxStart = $l;
                        $maxEnd   = $r;
                    }
                }
            }
        }
        return substr($s, $maxStart, $maxEnd - $maxStart + 1);
    }
}

$obj = new Solution();
$str = 'babad';
//$str = 'cbbd';
//$str = 'ac';
$string = $obj->longestPalindrome($str);
print_r($string);
