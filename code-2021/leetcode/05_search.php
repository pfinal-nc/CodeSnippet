<?php
/**
 * @author pfinal南丞
 * @date 2021年07月05日 下午5:11
 */

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        if(empty($s)){
            return 0;
        }
        $arr=str_split($s);//把字符串转化成数组
        $len=sizeof($arr);
        $l=0;//左指针
        $r=-1;//右指针
        $map=[];//记录哈希表
        $max=0;//最大值
        while($l<$len){
            if($r+1<$len&&!isset($map[$arr[$r+1]])){//第一次出现
                $map[$arr[++$r]]=1;//移动右指针
            }else{//出现过
                unset($map[$arr[$l++]]);//移动左指针
            }
            $max=max($max,$r-$l+1);//更新最大值
        }
        return $max;
    }
}

$obj = new Solution();
$str = "abcabcbb";
$new_str = $obj->lengthOfLongestSubstring($str);
var_dump($new_str);