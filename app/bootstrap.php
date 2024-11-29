<?php

function loadConfig(){
    $configFile = '..' . DIRECTORY_SEPARATOR . '.conf';
    if(!file_exists($configFile)){
        throw new Exception('File .conf does not exists');
    }
    $handle = fopen($configFile, 'r');
    if(!$handle){
        throw new Exception('Cannot access to .conf file');
    }
    while (!feof($handle)){
        $row = trim(fgets($handle));
        if(!empty($row) && strpos($row, '#') !== 0){
        //if(!empty($row) && !str_starts_with($row, '#')){
            putenv($row);
        }
    }
}

function conf(string $key){
    return getenv($key);
}

spl_autoload_register(function($class){
    $path = '..' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if(file_exists($path)){
        include_once $path;
        return true;
    }
    return false;
});

loadConfig();
if(conf('DEBUG') === 'true'){
    new \app\core\Route();
}else{
    try{
        new \app\core\Route();
    }catch (Exception $e){
        //запис в log  про конкретну помилку

        //відправка повідомлення про помилку

        //показати сторінку що щось пішло не так
        $view = new \app\core\View();
        $view->render('error', ['title'=>'oops']);
    }
}

