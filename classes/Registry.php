<?php

class Registry implements ArrayAccess
{

    private $vars=[];

    #region Singleton

    private static $instance=null;
    private function __construct(){
    }
    public static function getInstance():Registry{

        if(!isset(self::$instance) || self::$instance==null) {
            self::$instance = new Registry();
        }

        return self::$instance;
    }

    #endregion

    #region ArrayAccess
    public function offsetExists($key) : bool
    {
        return isset ($this->vars[$key]);
    }

    public function offsetGet($offset)
    {

        if($this->offsetExists($offset)) {

            return $this->vars[$offset];
        }
        else{
            return null;
        }
    }

    public function offsetSet($key, $value) : void
    {
        if($this->offsetExists($key)) {
            throw new Exception("Unable to set value, key $key already set");

        }
        $this->vars[$key] = $value;
    }

    public function offsetUnset($key) : void
    {
        unset($this->vars[$key]);
    }
    #endregion

    public static function Set($key, $value):void{

        self::getInstance()->offsetSet($key, $value);
    }
    public static function Get($key){

        return self::$instance->offsetGet($key);
    }
    public  static function Remove($key):void{

        self::getInstance()->offsetUnset($key);
    }
}