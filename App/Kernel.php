<?php

namespace App;

use App;

class Kernel
{

    const DEFAULT_CONTROLLER_NAME = 'Admin';

    const DEFAULT_ACTION_NAME = 'index';

    public function launch()
    {

        list($controllerName, $actionName, $params) = App::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);

    }


    /**
     * @param string $controllerName
     * @param string $actionName
     * @param array  $params
     *
     * @return string
     * @throws \Exceptions\InvalidRouteException
     */
    public function launchAction(string $controllerName = null, string $actionName = null, $params = null)
    {
        $controllerName = empty($controllerName) ? static::DEFAULT_CONTROLLER_NAME : ucfirst($controllerName);
        if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
            throw new \Exceptions\InvalidRouteException();
        }
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
            throw new \Exceptions\InvalidRouteException();
        }
        $controllerName = "\\Controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? static::DEFAULT_ACTION_NAME : $actionName;
        if (!method_exists($controller, $actionName)){
            throw new \Exceptions\InvalidRouteException();
        }
        return $controller->$actionName($params);

    }

}