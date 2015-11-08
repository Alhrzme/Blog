<?php
namespace application\models;

use application\additionally\Connection;

class TopicModel
{
    public $id;
    public $data;
    public $message;
    public $body;
    public $user_id;
    public $title;
    public $comments;

    public function createTopic ()
    {
        if($this->isFilled()){
            $this->title = $this->sanitizeString($this->title);
            $this->body = $this->sanitizeString($this->body);
            $this->insertTopicIntoDB();
        }
    }

    private function insertTopicIntoDB ()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("INSERT INTO topic(user_id, body, title) VALUES (:user_id, :body, :title)");
        $query->bindValue(':user_id', $this->user_id, \PDO::PARAM_INT);
        $query->bindValue(':body', $this->body, \PDO::PARAM_STR);
        $query->bindValue(':title', $this->title, \PDO::PARAM_STR);
        $query->execute();
        $this->message = 'Топик создан. Вы переместитесь туда через 3 секунды';
        echo'<script language="JavaScript">
                setTimeout(\'window.location.href = "/Topic/GetTopic?id='.$connection->lastInsertId().'"\', 3000)
             </script>';
    }

    private function isFilled()
    {
        if (empty($this->body) || empty($this->title)) {
            $this->message = 'Для создания топика необходимо, чтоб название и содержание топика были заполнены';
            return false;
        }
        else return true;
    }

    public function getTopicFromDB()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("SELECT * FROM topic WHERE id = '$this->id'");
        $query->execute();
        $this->data['topic'] = $query->fetch();
        $this->getUserNameById();
    }

    public function getUserNameById()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("SELECT username FROM users WHERE id = :user_id");
        $query->bindParam(':user_id', $this->data['topic']['user_id'], \PDO::PARAM_INT);
        $query->execute();
        $this->data['topic']['username'] = $query->fetch()['username'];
    }

    public function getSortedTopics()
    {
        $connection = Connection::getConnection();
        $query = $connection->query("SELECT id, title FROM topic ORDER BY id ");
        $idArr = $query->fetchAll(\PDO::FETCH_KEY_PAIR);
        return $idArr;
    }

    public static function deleteTopics(){
        $connection = Connection::getConnection();
        $query = "truncate topic; truncate comments";
        $connection->query($query);
    }

    private function sanitizeString($var)
    {
        return htmlentities(strip_tags($var));
    }

    public function editTopicBody()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("UPDATE topic SET body = :body WHERE id = $this->id");
        $query->bindValue(':body', $this->body, \PDO::PARAM_STR);
        $query->execute();
    }



}