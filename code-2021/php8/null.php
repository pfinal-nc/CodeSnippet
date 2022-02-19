<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午2:11
 */

class Person
{
    public $user;
    public $country;

    public function __construct()
    {
        $this->user = $this;
        $this->country = 'yes';
    }

    public function getAddress()
    {
        return $this;
    }
}

$session = new Person();

echo $session?->user?->getAddress()?->country;