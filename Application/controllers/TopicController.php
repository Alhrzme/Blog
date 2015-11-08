<?php
namespace application\controllers;

use application\models\TopicModel;
use application\views\view;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->model = new TopicModel();
        $this->view = new View();
    }

    public function actionGetTopic()
    {
        self::actionTopicInput();
        $this->model->id = $_GET['id'];
        $this->model->getTopicFromDB();
        $data['topic'] = $this->model->data['topic'];
        $data['comments'] = CommentsController::actionGetComments($_GET['id']);
        $this->view->generate('TopicPage.php', $data);
    }

    public function actionCreateTopic ()
    {
        $this->view->generate('CreateTopic.php');
    }

    public static function actionProcessing()
    {
        $model = new TopicModel();
        $model->body = $_POST['topicBody'];
        $model->title = $_POST['title'];
        $model->user_id = $_SESSION['id'];
        $model->createTopic();
        echo $model->message;
    }

    private static function actionTopicInput()
    {
        if(isset($_POST['editBody'])){
            self::editTopic();
        }
    }

    public static function actionCreateTopicInput()
    {
        if(isset($_REQUEST['topicBody'])){
            self::actionProcessing();
        }
    }

    private static function editTopic()
    {
        $model = new TopicModel();
        $model->id = $_GET['id'];
        $model->body = $_POST['topicBody'];
        $model->editTopicBody();
    }


}
