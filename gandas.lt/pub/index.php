<?php

$allowedControllers = ['user', 'api'];

if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/'){
    $pathInfo = strtolower(trim($_SERVER['PATH_INFO'], '/'));
    $pathInfo = explode('/', $pathInfo);

    $slug = isset($pathInfo[0]) ? $pathInfo[0] : null;
    if (in_array($slug, $allowedControllers)){
        $controller = $slug;
        $method = $first = isset($pathInfo[1]) ? $pathInfo[1] : 'index';
        $param = isset($pathInfo[2]) ? $pathInfo[2] : null;
    }else{
        $controller = 'news';
        $method = 'show';
        $param = $slug;

    }




}else{

    $controller = 'Home';
    $method = 'index';
    $param = null;

}