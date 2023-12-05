<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/5
 * Email: <lampxiezi@163.com>
 */

//class One
//{
//    private Closure $closure;
//    public function __construct(Closure $closure)
//    {
//        $this->closure = $closure;
//    }
//    public function doSomething()
//    {
//        if(1>2) {
//            // 用的时候在实例化
//            $instance = $this->closure();
//            $instance->do();
//        }
//    }
//}
//
//$instance = new One(function () {
//    return new Two();
//});
//
//$instance->doSomething();

// 关联数组做 map
//class One
//{
//    private array $map = [
//        'a' => 'namespace\A', // 带上命名空间，因为变量是动态的
//        'b' => 'namespace\B',
//        'c' => 'namespace\C'
//    ];
//    public function doSomething()
//    {
//        $instance = new $this->map[$strategy];// $strategy是'a'或'b'或'c'
//        $instance->doSomething(...);
//    }
//}
//$address          = "One Infinite Loop, Cupertino 95014";
//$cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
//preg_match($cityZipCodeRegex, $address, $matches);
//[, $city, $zipCode] = $matches;
//echo $city,$zipCode,PHP_EOL;
# saveCityZipCode($city, $zipCode);
# saveCityZipCode($city, $zipCode);
$address          = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(?<city>.+?)\s*(?<zipCode>\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);
print_r($matches);
# saveCityZipCode($matches['city'], $matches['zipCode']);

function isShopOpen(string $day): bool
{
    if (empty($day)) {
        return false;
    }
    $openingDays = ['friday', 'saturday', 'sunday'];
    return in_array($day, $openingDays);
}

/**
 * @throws Exception
 */
# 避免嵌套太深，尽早返回
function fibonacci(int $n): int
{
    if ($n === 0 || $n === 1) {
        return $n;
    }
    if ($n >= 50) {
        throw new Exception('Not supported');
    }
    return fibonacci($n - 1) + fibonacci($n - 2);
}

// 避免心理映射
//$locations = ['Austin', 'New York', 'San Francisco'];
//
//foreach ($locations as $location) {
//    doStuff();
//    doSomeOtherStuff();
//    // ...
//    // ...
//    // ...
//    dispatch($location);
//}

class Car
{
    public string $make;
    public string $model;
    public string $color;
}

# 空合并运算符
/*
    if(isset($_GET['name'])) {
        $name = $_GET['name']
    }elseif (isset($_POST['name'])) {
        $name = $_POST['name']
    } else {
        $name = 'nobody';
    }
 */
$name = $_GET['name'] ?? $_POST['name'] ?? 'nobody';
echo $name . PHP_EOL;
# 使用默认参数而不是短路或条件
function createMicrobrewery(string $breweryName = 'Hipster Brew Co.'): void
{
    // ...
}

// 函数参数 限制函数参数的数量非常重要, 因为它使测试函数变得更加容易。超过三个会导致组合爆炸,必须使用每个单独的参数来测试大量不同的情况
//class Questionnaire
//{
//    public function __construct(
//        string $firstname,
//        string $lastname,
//        string $patronymic,
//        string $region,
//        string $district,
//        string $city,
//        string $phone,
//        string $email
//    ) {
//        // ...
//    }
//}

class Name
{
    protected string $firstname;
    protected string $lastname;
    protected string $patronymic;

    public function __construct(string $firstname, string $lastname, string $patronymic)
    {
        $this->firstname  = $firstname;
        $this->lastname   = $lastname;
        $this->patronymic = $patronymic;
    }
}

class City
{
    protected string $region;
    protected string $district;
    protected string $city;

    public function __construct(string $region, string $district, string $city)
    {
        $this->region   = $region;
        $this->district = $district;
        $this->city     = $city;
    }
}

class Contact
{
    protected string $phone;
    protected string $email;

    public function __construct(string $phone, string $email)
    {
        $this->phone = $phone;
        $this->email = $email;
    }
}

class Questionnaire
{
    public function __construct(Name $name, City $city, Contact $contact)
    {
        // ....
    }
}

// 代码单一原则
//class UserSettings
//{
//    private $user;
//
//    public function __construct(User $user)
//    {
//        $this->user = $user;
//    }
//
//    public function changeSettings(array $settings): void
//    {
//        if ($this->verifyCredentials()) {
//            // ...
//        }
//    }
//
//    private function verifyCredentials(): bool
//    {
//        // ...
//    }
//}

//class UserAuth
//{
//    private $user;
//
//    public function __construct(User $user)
//    {
//        $this->user = $user;
//    }
//
//    public function verifyCredentials(): bool
//    {
//        // ...
//    }
//}

//class UserSettings
//{
//    private $user;
//
//    private $auth;
//
//    public function __construct(User $user)
//    {
//        $this->user = $user;
//        $this->auth = new UserAuth($user);
//    }
//
//    public function changeSettings(array $settings): void
//    {
//        if ($this->auth->verifyCredentials()) {
//            // ...
//        }
//    }
//}
# 开闭原则
interface Adapter
{
    public function request(string $url): Promise;
}

//class AjaxAdapter implements Adapter
//{
//    public function request(string $url): Promise
//    {
//        // request and return promise
//    }
//}

//class NodeAdapter implements Adapter
//{
//    public function request(string $url): Promise
//    {
//        // request and return promise
//    }
//}
//
//class HttpRequester
//{
//    private $adapter;
//
//    public function __construct(Adapter $adapter)
//    {
//        $this->adapter = $adapter;
//    }
//
//    public function fetch(string $url): Promise
//    {
//        return $this->adapter->request($url);
//    }
//}

