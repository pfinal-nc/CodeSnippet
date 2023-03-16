<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/14
 * Email: <lampxiezi@163.com>
 */

#[Attribute]
class ListensTo
{
    public string $event;

    public function __construct(string $event)
    {
        $this->event = $event;
    }
}

$price = 100_10;
print_r($price);

echo PHP_EOL;

$error = fn($message) => throw new Error($message);
//$data = [];
//$input = $data['input'] ?? throw new Exception('Input not set');
# 多层匹配
$statusCode = 400;
$message = match ($statusCode) {
    200, 300 => null,
    400 => 'not found',
    500 => 'server error',
    default => 'unknown status code',
};
print_r($message.PHP_EOL);
