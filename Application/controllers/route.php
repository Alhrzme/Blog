<?php

namespace application\controllers;

class Route
{
    public static function start()
    {
        //контроллер и действие по умолчанию
        $controller_name = 'Main';
        $actionName = 'Index';

        //Задаем массив _GET[]
        $sortedUrl = explode('?', $_SERVER['REQUEST_URI']);
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $_GET);

        //Разбираем URL
        $urlWithoutGET = $sortedUrl[0];
        $routes = explode('/', $urlWithoutGET);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = $routes[1];

        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $actionName = $routes[2];

        }

        // добавляем префикс
        $controller_name = 'application\controllers\\'.$controller_name . 'Controller';
        $actionName = 'action' . $actionName;


        try {
            $controller = new $controller_name;
            $controller->$actionName();
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }

        /*} else {
            /*правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            Route::ErrorPage404();
        }*/
    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
