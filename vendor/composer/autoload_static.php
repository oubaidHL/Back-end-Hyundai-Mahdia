<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11e1ebea6529667fac1cf3106d89ecf7
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11e1ebea6529667fac1cf3106d89ecf7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11e1ebea6529667fac1cf3106d89ecf7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
