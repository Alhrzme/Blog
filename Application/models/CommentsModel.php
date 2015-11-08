<?php
namespace application\models;

use application\additionally\Connection;

class CommentsModel
{
    public $parent_id;
    public $user_id;
    public $topic_id;
    public $body;
    public $date;
    public $message;
    public $data;

    public function addNewComment(){
        if($this->checkData()){
            $this->addNewCommentIntoDB();
            return $this->getComments();
        }
        return $this->message;//На всякий случай, на потом.
    }
    private function addNewCommentIntoDB()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("INSERT INTO comments(parent_id, user_id, topic_id, body, date) VALUES (:parent_id, :user_id, :topic_id, :body, $this->date)");
        $query->bindValue(':user_id', $this->user_id, \PDO::PARAM_STR);
        $query->bindValue(':parent_id', $this->parent_id, \PDO::PARAM_STR);
        $query->bindValue(':topic_id', $this->topic_id, \PDO::PARAM_STR);
        $query->bindValue(':body', $this->body, \PDO::PARAM_STR);
        $query->execute();
    }
    private function sanitizeString($var)
    {
        $var = stripslashes($var);
        $var = htmlentities($var);
        $var = strip_tags($var);
        return $var;
    }

    public function returnComments(){
        $json =$this->addNewComment();
        return print $json;
    }

    public function getComments()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("SELECT  comments.id, body, parent_id,user_id,topic_id,date,username FROM comments JOIN users ON comments.user_id=users.id WHERE topic_id = '$this->topic_id'");
        $query->execute();
        $this->data = $query->fetchAll();
        return json_encode($this->data,JSON_UNESCAPED_UNICODE);
    }

    private function isBodyFilled()
    {
        if(!empty($this->body)){
            return true;
        }
        $this->message = 'Коммент пустой...';
        return false;
    }

    private function checkData()
    {
        if($this->isBodyFilled()){
            $this->body = $this->sanitizeString($this->body);
            return true;
        }
        return false;
    }



}