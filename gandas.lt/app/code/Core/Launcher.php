<?php

namespace Core;

class Launcher
{
    public function start($routeInfo)
    {

        list($controller, $method, $param) = $routeInfo;
        $controller = ucfirst($controller);
        $controller = '\Controller\\'.$controller;
        $controllerObject = new $controller;
        $controllerObject->$method($param);
    }
}