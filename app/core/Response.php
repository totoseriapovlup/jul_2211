<?php


namespace app\core;


class Response
{
    public static function json(array $data){
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}