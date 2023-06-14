<?php

require_once "./includes/config.php";
require_once  "./includes/startup.php";

session_start();


$router = new Router();


Registry::Set("router", $router);

try{

    $router->setControllersDirPath($GLOBALS["rootDir"]."_controllers");
    $router->setViewsDirPath($GLOBALS["rootDir"]."_views");
}
catch (Exception $ex){

    die($ex->getMessage());
}



$router->delegate();