<?php
/**
 * Author: PFinal南丞
 * Date: 2023/12/5
 * Email: <lampxiezi@163.com>
 */
session_start();

$_SESSION['lang'] = 'en';

//Check if language is set
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Include language file
include_once './lang/' . $_SESSION['lang'] . '.php';

function __($text): string
{
    global $lang;
    return $lang[$text] ?? $text;
}

echo __('welcome');