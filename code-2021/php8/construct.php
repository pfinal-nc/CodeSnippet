<?php
/**
 * @author pfinal南丞
 * @date 2021年04月08日 下午2:14
 */

class User
{
    /**
     * User constructor.
     * @param string $kaka
     */
    public function __construct(public string $kaka)
    {
        echo $this->kaka;
    }
}