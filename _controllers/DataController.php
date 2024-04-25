<?php

class DataController extends BaseController
{
    public function index()
    {

        header("Content-Type: application/json");
        $data = [];

        $records = Registry::Get("pdo")->query("SELECT `id`, `FirstName`, `LastName`, `Age` FROM `test`");

        foreach ($records as $row){

             array_push($data, $row );
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}