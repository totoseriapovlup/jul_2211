<?php


namespace app\controllers;

use app\core\AbstractController;
use app\models\Note;

class Admin extends AbstractController
{
    public function index()
    {
        $this->view->render('admin', [
            'title' => 'dashboard',
        ]);
    }

    public function create(){
        $this->view->render('create', [
            'title' => 'dashboard|create note',
        ]);
    }

    public function store(){
        $note = filter_input(INPUT_POST, 'note');
        //validate
        //1.check note by conditions
        //2.write errors if exists to SESSION
        //3.if errors exist redirect to form

        //save new note
        $noteModel = new Note();
        $noteModel->add(['name'=>$note]);
    }
}