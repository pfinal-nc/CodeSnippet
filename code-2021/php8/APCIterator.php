<?php
/**
 * @author pfinal南丞
 * @date 2021年07月08日 下午4:22
 */


echo "是否继续(yes/no):";
$handle = fopen("php://stdin", "r");
$line   = trim(fgets($handle)) ?: 'y';
if (trim($line) != 'yes' && trim($line) != 'y') {
    echo "PFinal Club! \n";
    exit;
}

echo "  菜单列表    " . PHP_EOL;

echo "1> PHP版本 " . PHP_EOL;

echo "2> PHP扩展 " . PHP_EOL;
echo "选择菜单(1/2):";

$handle = fopen("php://stdin", "r");
$menu   = fgets($handle);

if (!in_array(trim($menu), [1, 2])) {
    echo "Good Bye" . PHP_EOL;
    exit;
}

switch ($menu){
    case 1:
        echo "|+++++++++++++++++++++++++++++++++++++++++++++++++++++++++|".PHP_EOL;
        echo `php -v`;
        echo "|+++++++++++++++++++++++++++++++++++++++++++++++++++++++++|".PHP_EOL;
    break;
    case 2:
        echo "|+++++++++++++++++++++++++++++++++++++++++++++++++++++++++|".PHP_EOL;
        echo `php -m`;
        echo "|+++++++++++++++++++++++++++++++++++++++++++++++++++++++++|".PHP_EOL;
}