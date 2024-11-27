<?php


namespace app\controllers;

use app\core\AbstractController;
use app\core\View;

class Index extends AbstractController
{
    public function index()
    {
        $this->view->render('index', [
            'title' => 'home',
        ]);
    }

    public function show()
    {
        echo 'Index controller show action';
    }
}