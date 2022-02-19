<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午2:07
 */

$name = match(2) {
    1 => 'kaka',
    2 => 'niuiniu',
};
var_dump($name);

//$method = $_SERVER['REQUEST_METHOD'];
//
//$method = match($method) {
//    'post' => $this->handlePost(),
//    'get','put' =>  $this->handleGet(),
//};
//
//var_dump($method);

$name = match(3) {
    1 => 'kaka',
    2 => 'niuniu',
    default => 'heihei',
};

echo $name;  // heihei