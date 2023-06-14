<?php


class Router
{
    private $controllersDir;
    private $viewsDir;

    public function __construct()
    {
        $this->controllersDir = $GLOBALS["rootDir"]."controllers";
        $this->viewsDir = $GLOBALS["rootDir"]."views";
    }

    public function setControllersDirPath($path){

        $path.=DIRECTORY_SEPARATOR;
        if(!is_dir($path)){
            throw new Exception("Invalid controllers directory path");
        }
        $this->controllersDir = $path;
    }
    public function setViewsDirPath($path){

        $path.=DIRECTORY_SEPARATOR;
        if(!is_dir($path)){
            throw new Exception("Invalid views directory path");
        }
        $this->viewsDir = $path;
    }

    public function delegate(){

        $this->getController($file, $controller, $action, $args);

        if(!is_readable($file)){
            die("Error 404: Controller not found");
            //TO DO Go to 404 error;
        }

        require_once ($file);

        //create controller instance
        $className = $controller."Controller";
        $ctrlInstance = new $className;

        //is action present?
        if(!method_exists($className, $action)) {

            die("Error 404 action $action in class $className not found");
        }

        $view = $ctrlInstance->$action ($args);



        if($view != null){

            $view->setControllerName($controller);
            $view->showView($action);
        }
    }
    private function getController(&$file, &$controller, &$action, &$args){

        $controller = "Home";
        $route = "index";
        if(isset($_GET["route"])){
            $route = $_GET["route"];
        }

        $route = trim($route, "/\\");
        $route = preg_replace("/\/|\\\\/i", DIRECTORY_SEPARATOR, $route);
        $parts=explode(DIRECTORY_SEPARATOR, $route);

        $cmd_path = $this->controllersDir;


        foreach ($parts as $part){

            $fullPath = $cmd_path.$part;

            //if is directory
            if(is_dir($fullPath)){

                $cmd_path.=$part.DIRECTORY_SEPARATOR;
                array_shift($parts);
                continue;
            }
            //if is controller
            if(is_file($fullPath."Controller.php")){

                $controller = $part;
                array_shift($parts);
                break;
            }
        }



        if(empty($controller)){
            $controller="Error";
            $action="index";
            return;
        }
        $action = array_shift($parts);

        if(empty($action)){
            $action="index";
        }

        $file=$cmd_path.$controller."Controller.php";

        $args = $parts;
    }
}