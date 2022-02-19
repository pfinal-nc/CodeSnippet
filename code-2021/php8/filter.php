<?php
/**
 * @author pfinal南丞
 * @date 2021年07月09日 上午10:19
 */

# PHP filter 过滤器函数
$email1 = 'huanggy@example.org';
$email2 = "example.org";
$email3 = "(huanggy@example.org)";
# var_dump(filter_var($email1, FILTER_VALIDATE_EMAIL));
# var_dump(filter_var($email2, FILTER_VALIDATE_EMAIL));
# var_dump(filter_var($email3, FILTER_SANITIZE_EMAIL));

# print_r(filter_list());
# var_dump(filter_var("1", FILTER_VALIDATE_IP));

# filter_id  返回与某个特定名称的过滤器相关联的id
//foreach (filter_list() as $item) {
//    var_dump(filter_id($item));
//}

# filter_has_var 检测是否存在指定类型的变量
# filter_has_var(type) type 类型有 INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV
// $_GET['test'] = 1;
// if (!filter_has_var(INPUT_GET, "test")) {
//    echo("Input type does not exist" . PHP_EOL);
// } else {
//    echo("Input type exists" . PHP_EOL);
// }

# filter_input  通过名称获取特定的外部变量，并且可以通过过滤器处理它
# filter_input_array  从脚本外部获取多项输入，并进行过滤。
//$_POST = array(
//    'product_id' => 'libgd<script>',
//    'component'  => '10',
//    'versions'   => '2.0.33',
//    'testscalar' => array('2', '23', '10', '12'),
//    'testarray'  => '2',
//);
//$args  = array(
//    'product_id'   => FILTER_SANITIZE_ENCODED,
//    'component'    => array('filter'  => FILTER_VALIDATE_INT,
//                            'flags'   => FILTER_REQUIRE_ARRAY,
//                            'options' => array('min_range' => 1, 'max_range' => 10)
//    ),
//    'versions'     => FILTER_SANITIZE_ENCODED,
//    'doesnotexist' => FILTER_VALIDATE_INT,
//    'testscalar'   => array(
//        'filter' => FILTER_VALIDATE_INT,
//        'flags'  => FILTER_REQUIRE_SCALAR,
//    ),
//    'testarray'    => array(
//        'filter' => FILTER_VALIDATE_INT,
//        'flags'  => FILTER_REQUIRE_ARRAY,
//    )
//
//);
//
//$myinputs = filter_input_array(INPUT_POST, $args);
//var_dump($myinputs);

//function myfilter($str)
//{
//    return str_replace('9', '5', $str);
//}
//
//// 类方式
//
//class MyFilter
//{
//    public function filter1($str)
//    {
//        return str_replace('9', '6', $str);
//    }
//}
//
//echo filter_var('wo9w9w9', FILTER_CALLBACK, array('options' => 'myfilter')) . PHP_EOL;    // 函数方式的回调
//echo filter_var('wo9w9w9', FILTER_CALLBACK, array('options' => array(new MyFilter(), 'filter1'))) . PHP_EOL;   // 类方法方式的回调


# filter_var_array() 获取多个变量进行过滤
$arr     = [
    "name"  => "peter griffin",
    "age"   => "41",
    "email" => "peter@example.com",
];
$filters = [
    "name"  => [
        "filter"  => FILTER_CALLBACK,
        "flags"   => FILTER_FORCE_ARRAY,
        "options" => "ucwords"
    ],
    "age"   => [
        "filter"  => FILTER_VALIDATE_INT,
        "options" => [
            "min_range" => 1,
            "max_range" => 120
        ]
    ],
    "email" => FILTER_VALIDATE_EMAIL,
];

print_r(filter_var_array($arr, $filters));


