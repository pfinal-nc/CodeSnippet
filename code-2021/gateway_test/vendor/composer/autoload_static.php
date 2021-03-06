<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb387496d0cfa81876348e4e0866fa15
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\' => 10,
        ),
        'G' => 
        array (
            'GatewayWorker\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/workerman',
        ),
        'GatewayWorker\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/gateway-worker/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbb387496d0cfa81876348e4e0866fa15::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbb387496d0cfa81876348e4e0866fa15::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbb387496d0cfa81876348e4e0866fa15::$classMap;

        }, null, ClassLoader::class);
    }
}
