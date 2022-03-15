<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cd237153d6bbe571145c299ff201192
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Admin\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/admin/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9cd237153d6bbe571145c299ff201192::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9cd237153d6bbe571145c299ff201192::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9cd237153d6bbe571145c299ff201192::$classMap;

        }, null, ClassLoader::class);
    }
}
