<?php

class View
{
    private $controller;
    public function setControllerName($controller){

        $this->controller = $controller;
    }

    public function showView($action){

        //print_r($action);
        //echo  "<html><head><title>TEST</title></head><body><h1>TEST</h1></body></html>";
        $file = $GLOBALS["rootDir"]."_views".DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$action.".php";

        //print_r($file);

        include $file;
    }
}