<?php

namespace application\controllers;

use application\views\view;
use application\models\PersonalAccountModel;

class PersonalPageController {

    public function __construct()
    {
        $this->view = new View();
        $this->model = new PersonalAccountModel();
    }

    public function actionIndex(){
        $this->model->id = $_GET['id'];
        $data = $this->model->getUserData() ;
        $this->view->generate('PersonalAccount.php', $data);
    }
}