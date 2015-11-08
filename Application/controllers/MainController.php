<?php

namespace application\controllers;

use application\views\view;
use application\models\TopicModel;

class MainController extends Controller
{
    public function __construct(){
        $this->model = new TopicModel();
        $this->view = new View();
    }
    public function actionIndex()
    {
        self::checkButton();
        $data = $this->model->getSortedTopics();
        $this->view->generate('MainView.php', $data);
    }

    public static function checkButton()
    {
        if(isset($_REQUEST['delete'])){
            TopicModel::deleteTopics();
        }
    }

}