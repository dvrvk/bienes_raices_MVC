<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit59b5ecb4bd06f240a2e27f4d1a6d05ee
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit59b5ecb4bd06f240a2e27f4d1a6d05ee', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit59b5ecb4bd06f240a2e27f4d1a6d05ee', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit59b5ecb4bd06f240a2e27f4d1a6d05ee::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit59b5ecb4bd06f240a2e27f4d1a6d05ee::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire59b5ecb4bd06f240a2e27f4d1a6d05ee($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire59b5ecb4bd06f240a2e27f4d1a6d05ee($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}