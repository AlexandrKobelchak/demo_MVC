<?php

class ErrorController extends BaseController
{

    public function index()
    {
        echo "<html><head><title>ERROR</title></head><body><h1>Error 404  Controller not found</h1></body></html>";
        return null;
    }
}