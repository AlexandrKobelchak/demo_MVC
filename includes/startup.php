<?php

$rootDir = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;


spl_autoload_register(function ($className){

    $file = $GLOBALS["rootDir"]."classes".DIRECTORY_SEPARATOR.$className.".php";

    if(!file_exists($file)){

        return false;
    }
    require_once $file;
    return true;
});

error_reporting(E_ALL);

if(version_compare(phpversion(), "7.1.0", "<")){

    die ("Minimal request php version 7.1 !!!!!");
}