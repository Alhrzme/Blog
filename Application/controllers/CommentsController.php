<?php
namespace application\controllers;

use application\models\CommentsModel;

class CommentsController extends Controller {
    public static function actionSetNewComment() {
        $model = new CommentsModel();
        $model->body = $_POST['commentsBody'];
        $model->user_id = $_SESSION['id'];
        $model->topic_id = $_POST['topic_id'];
        $model->parent_id = $_POST['parent_id'];
        $model->date = $_SERVER['REQUEST_TIME'];
        return $model->returnComments();
    }

    public static function actionGetComments($topic_id) {
        $model = new CommentsModel();
        $model->topic_id = $topic_id;
        return $model->getComments();
    }
}