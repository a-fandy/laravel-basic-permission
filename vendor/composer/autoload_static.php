<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit091256f4cc151863ec188219512bf2b8
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Afdn\\Permission\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Afdn\\Permission\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit091256f4cc151863ec188219512bf2b8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit091256f4cc151863ec188219512bf2b8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit091256f4cc151863ec188219512bf2b8::$classMap;

        }, null, ClassLoader::class);
    }
}
