<?php

class App
{
    /** @var App\Router */
    public static $router;
    /** @var App\Db */
    public static $db;
    /** @var App\Kernel */
    public static $kernel;

    /**
     * Инициализация приложения
     */
    public static function init()
    {
        spl_autoload_register(['static','loadClass']);
        static::bootstrap();
        set_exception_handler(['App','handleException']);

    }

    public static function bootstrap()
    {
        static::$router = new App\Router();
        static::$kernel = new App\Kernel();
        static::$db = new App\Db();

    }

    public static function loadClass ($className)
    {

        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH.DIRECTORY_SEPARATOR.$className.'.php';

    }

    public function handleException (Throwable $e)
    {

        if($e instanceof \Exceptions\InvalidRouteException) {
            echo static::$kernel->launchAction('Error', 'error404', [$e]);
        }else{
            echo  '<pre>';
            var_dump($e);
            echo static::$kernel->launchAction('Error', 'error500', [$e]);
        }

    }

}