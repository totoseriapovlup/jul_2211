<?php


namespace app\models;


class Note
{
    protected $db;

    public function __construct()
    {
        $this->db = new \mysqli(conf('DB_HOST'), conf('DB_USER'), conf('DB_PASS'), conf('DB_NAME'));
        var_dump($this->db);
        exit();
    }

    public function all(){

    }

    public function add(array $note){
        $query = "INSERT INTO notes (name) VALUES ('{$note['name']}');";

    }

    public function get($id){

    }

    public function update(array $note){

    }

    public function delete($id){

    }

}