<?php

namespace application\controllers;

use application\models;
use application\views;


class SearchController
{
    public function __construct()
    {
        $this->view = new views\View;
        $this->model = new models\SearchModel();
    }

    public function actionIndex()
    {
        $data = $this->searchProcessing();
        $this->view->generate('SearchView.php', $data);
    }


    private function searchProcessing(){
        $this->model->string = $_GET['q'];
        return $this->model->getSearch();
    }


}