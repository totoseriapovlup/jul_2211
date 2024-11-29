<?php


namespace app\controllers;

use app\core\AbstractController;
use app\core\Route;
use app\models\Note;

class Admin extends AbstractController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Note();
    }

    public function index()
    {
        $notes = $this->model->all();
        $this->view->render('admin', [
            'title' => 'dashboard',
            'notes' => $notes,
        ]);
    }

    public function create()
    {
        $this->view->render('create', [
            'title' => 'dashboard|create note',
        ]);
    }

    public function store()
    {
        $note = filter_input(INPUT_POST, 'note');
        //validate
        //1.check note by conditions
        //2.write errors if exists to SESSION
        //3.if errors exist redirect to form

        //save new note
        $this->model->add(['name' => $note]);
        Route::redirect(Route::url('admin', 'index'));
    }

    public function destroy(){
        $id = filter_input(INPUT_POST, 'id');
        //TODO validate
        $this->model->delete($id);
        Route::redirect(Route::url('admin', 'index'));
    }
}