<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit294af677e7e5ca79a68139e005384c60
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit294af677e7e5ca79a68139e005384c60::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit294af677e7e5ca79a68139e005384c60::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit294af677e7e5ca79a68139e005384c60::$classMap;

        }, null, ClassLoader::class);
    }
}
