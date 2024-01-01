<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit24462beaedaca5a7b497cc87d49c37f6
{
    public static $files = array (
        '48a0c493cd6757d584d285a110a175e9' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LicenseEnvato\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LicenseEnvato\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit24462beaedaca5a7b497cc87d49c37f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit24462beaedaca5a7b497cc87d49c37f6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit24462beaedaca5a7b497cc87d49c37f6::$classMap;

        }, null, ClassLoader::class);
    }
}