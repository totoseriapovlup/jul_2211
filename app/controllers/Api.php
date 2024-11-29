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
}