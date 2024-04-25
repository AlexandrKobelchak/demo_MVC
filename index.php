<?php

require_once "./includes/config.php";
require_once  "./includes/startup.php";

session_start();



$router = new Router();
Registry::Set("router", $router);
/*
echo "Test";

Registry::Set("pdo", new PDO("mysql:host=".Config::databaseServer."; dbname=".Config::databaseName,
    Config::databaseUser, Config::databasePasswd));

Registry::Get("pdo")->exec("SET NAMES 'utf-8'");
Registry::Get("pdo")->exec("SET CHARACTER SET 'utf-8'");
*/



try{

    $router->setControllersDirPath($GLOBALS["rootDir"]."_controllers");
    $router->setViewsDirPath($GLOBALS["rootDir"]."_views");
}
catch (Exception $ex){

    die($ex->getMessage());
}



$router->delegate();