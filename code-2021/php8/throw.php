<?php
/**
 * @author pfinal南丞
 * @date 2021年05月27日 上午11:28
 */

function show(int $number){

    if($number<10){
        throw new Exception('this value must be greater or equal 10');
    }else{
        echo $number;
    }
}

try{
    show(5);
}catch(Exception $e){
    echo $e->getMessage();
}