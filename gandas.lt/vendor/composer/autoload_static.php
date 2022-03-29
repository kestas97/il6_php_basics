<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1b85341a6eb1795a62dafed797bc8938
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kestas\\GandasLt\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kestas\\GandasLt\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit1b85341a6eb1795a62dafed797bc8938::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1b85341a6eb1795a62dafed797bc8938::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1b85341a6eb1795a62dafed797bc8938::$classMap;

        }, null, ClassLoader::class);
    }
}