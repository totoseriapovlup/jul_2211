<?php

namespace app\core;


class Route
{
    const CONTROLLER_NAMESPACE = 'app\controllers\\';
    const DEFAULT_NAME = 'index';

    private $url = '';

    private $urlComponents = [];

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->loadUrlComponents();
        $this->init();
    }

    public function init(){
        $controllerName = $this->getUrlComponent(0);
        $action = $this->getUrlComponent(1);
        $controllerClass = self::CONTROLLER_NAMESPACE . ucfirst($controllerName);
        if(!class_exists($controllerClass)){
            self::notFound();
        }
        $controller = new $controllerClass();
        if(!method_exists($controller, $action)){
            self::notFound();
        }
        if(!($controller instanceof controllable)){
            throw new \InvalidArgumentException();
        }
        $controller->$action();
    }

    private function loadUrlComponents(){
        $this->url = strtolower($this->url);
        $this->urlComponents = explode('/', $this->url);
        //delete first element witch always empty
        array_shift($this->urlComponents);
    }

    private function getUrlComponent($i){
        $component = self::DEFAULT_NAME;
        if(!empty($this->urlComponents[$i])){
            $component = $this->urlComponents[$i];
        }
        return $component;
    }

    public static function notFound(){
        http_response_code(404);
        exit();
    }

    /**
     * Create url for controller and action
     * @param string $controller
     * @param string $action
     * @return string
     */
    public static function url(string $controller = self::DEFAULT_NAME, string $action = self::DEFAULT_NAME) : string
    {
        return '/' . $controller . '/' . $action;
    }
}