<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/1
 * Email: <lampxiezi@163.com>
 */

require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set('Asia/Shanghai');
$climate = new \League\CLImate\CLImate;
//$climate->red("红色的输出");
//$climate->out('打印到终端.');
////$client->blue("蓝色输出:".$quit);
//$climate->inline('Waiting');
//for ($i = 0; $i < 10; $i++) {
//    $climate->inline('.');
//}
//echo PHP_EOL;
//$climate->red('输出的这一行是红色');
//$climate->blue('蓝色！');
//$climate->lightGreen('淡淡的绿色');
//$climate->arguments->add([
//    'user' => [
//        'prefix'       => 'u',
//        'longPrefix'   => 'user',
//        'description'  => 'Username',
//        'defaultValue' => 'me_myself_i',
//    ],
//    'password' => [
//        'prefix'      => 'p',
//        'longPrefix'  => 'password',
//        'description' => 'Password',
//        'required'    => true,
//    ],
//    'iterations' => [
//        'prefix'      => 'i',
//        'longPrefix'  => 'iterations',
//        'description' => 'Number of iterations',
//        'castTo'      => 'int',
//    ],
//    'verbose' => [
//        'prefix'      => 'v',
//        'longPrefix'  => 'verbose',
//        'description' => 'Verbose output',
//        'noValue'     => true,
//    ],
//    'help' => [
//        'longPrefix'  => 'help',
//        'description' => 'Prints a usage statement',
//        'noValue'     => true,
//    ],
//    'path' => [
//        'description' => 'The path to push',
//    ],
//]);
//$climate->description('My CLI Script');
//
//$options  = ['Ice Cream', 'Mixtape', 'Teddy Bear', 'Pizza', 'Puppies'];
//$input    = $climate->checkboxes('Please send me all of the following:', $options);
//$response = $input->prompt();
//$climate->out('You selected: ' .  implode(', ', $response));

$data = [
    [
        'name'       => 'Walter White',
        'role'       => 'Father',
        'profession' => 'Teacher',
    ],
    [
        'name'       => 'Skyler White',
        'role'       => 'Mother',
        'profession' => 'Accountant',
    ],
    [
        'name'       => 'Walter White Jr.',
        'role'       => 'Son',
        'profession' => 'Student',
    ],
];

$climate->table($data);

$progress = $climate->progress()->total(100);

for ($i = 0; $i <= 100; $i++) {
    $progress->current($i);
    // Simulate something happening
    usleep(80000);
}

$climate->out(date('Y-m-d H:i:s'));