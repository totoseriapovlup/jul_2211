<?php


namespace app\models;


class Note
{
    protected $db;

    public function __construct()
    {
        $this->db = new \mysqli(conf('DB_HOST'), conf('DB_USER'), conf('DB_PASS'), conf('DB_NAME'));
    }

    public function all() : array
    {
        $query = "SELECT * FROM notes;";
        $result = $this->db->query($query);
        if($result){
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function add(array $note) : bool
    {
        $query = "INSERT INTO notes (name) VALUES ('{$note['name']}');";
        return $this->db->query($query);
    }

    public function get($id){

    }

    public function update(array $note){

    }

    public function delete(int $id){
        $query = "DELETE FROM notes WHERE id = $id;";
        return $this->db->query($query);
    }

}