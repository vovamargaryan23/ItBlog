<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit90062932688a174b4039824ac20e668a
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'ISPager\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ISPager\\' => 
        array (
            0 => __DIR__ . '/..' . '/igorsimdyanov/pager/src/ISPager',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit90062932688a174b4039824ac20e668a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit90062932688a174b4039824ac20e668a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}