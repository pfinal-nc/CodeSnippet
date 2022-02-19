<?php
/**
 * @author pfinal南丞
 * @date 2021年05月28日 下午3:41
 */
var_dump(ip2long('124.205.30.150'));
list($p1,$p2,$p3,$p4) = explode('.','124.205.30.150');
var_dump(($p1<<24)+($p2<<16)+($p3<<8)+$p4);