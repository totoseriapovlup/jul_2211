<?php


namespace app\controllers;

use app\core\controllable;
use app\core\Response;
use app\models\Note;

class Api implements controllable
{
    protected $model;

    public function __construct()
    {
        $this->model = new Note();
    }

    public function index()
    {
        $notes = $this->model->all();
        Response::json($notes);
    }

    public function store()
    {
        $note = filter_input(INPUT_POST, 'note');
        //validate
        //1.check note by conditions
        //2.write errors if exists to SESSION
        //3.if errors exist redirect to form

        //save new note
        $res = $this->model->add(['name' => $note]);
        http_response_code($res ? 201 : 500);
    }

    public function destroy(){
        $id = filter_input(INPUT_POST, 'id');
        $res = $this->model->delete($id);
        http_response_code($res ? 204 : 500);
    }
}