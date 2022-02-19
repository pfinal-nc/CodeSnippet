<?php
/**
 * @author pfinal南丞
 * @date 2021年07月08日 下午5:47
 */

$bar = 'BAR';
apcu_add('foo', $bar);
var_dump(apcu_fetch('foo'));