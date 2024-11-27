<?php


namespace app\core;


abstract class AbstractController implements controllable
{
    public View $view;

    public function __construct()
    {
        $this->view = new View();
    }
}