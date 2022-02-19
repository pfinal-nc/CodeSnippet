<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 上午11:55
 */

//PHP7

//class  Number
//{
//    /**
//     * @var int|float
//     */
//    private $number;
//
//    /**
//     * Number constructor.
//     * @param float|int $number
//     */
//    public function __construct($number)
//    {
//        $this->number = $number;
//    }
//}

// PHP8
class Number
{
    public function __construct(private int|float $number)
    {
        var_dump($this->number);
    }
}

try {
    $obj = new Number(11);
    var_dump($obj);
}catch (\Exception $exception) {
    var_dump($exception->getMessage());
}
