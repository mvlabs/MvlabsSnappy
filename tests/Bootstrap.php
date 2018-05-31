<?php
/*
$vendorDir = __DIR__ . '/../vendor';

if (file_exists($file = $vendorDir . '/autoload.php')) {
    require_once $file;
} elseif (file_exists($file = __DIR__ . '/../../../vendor/autoload.php')) {
    require_once $file;
} else {
    throw new \RuntimeException("Composer autoload not found");
}*/

namespace MvlabsSnappyTest;

use Zend\Mvc\Application;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    protected static $serviceManager;
    protected static $application;

    public static function init()
    {
        $appConfig = [
            'module_listener_options' => [
                'module_paths' => [
                    './../module',
                    './../vendor',
                ],
            ],
            'modules' => [
                'Zend\Router',
                'Zend\Validator',
                'MvlabsSnappy',
            ]
        ];

        static::$application = Application::init($appConfig);

        $events = static::$application->getEventManager();
        static::$application->getServiceManager()->get('SendResponseListener')->detach($events);
        static::$serviceManager = static::$application->getServiceManager();
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }
}

Bootstrap::init();
