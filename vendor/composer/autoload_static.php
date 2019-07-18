<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf7e2c49a5a096feeb76c7ab67ba7caf1
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Moment\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Moment\\' => 
        array (
            0 => __DIR__ . '/..' . '/fightbulc/moment/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf7e2c49a5a096feeb76c7ab67ba7caf1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf7e2c49a5a096feeb76c7ab67ba7caf1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
