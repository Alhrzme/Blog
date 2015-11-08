<?php

namespace application\controllers;

use application\views\view;

class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex()
    {
    }
}