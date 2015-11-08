<?php

namespace application\models;

use application\additionally\Connection;

class PersonalAccountModel
{
    public $id;
    public $data;

    public function getUserData()
    {
        $this->getUserPersonalData();
        $this->getUserTopics();
        return $this->data;
    }
    private function getUserPersonalData()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("SELECT username, email, realname FROM users WHERE id = :id");
        $query->bindValue(':id', $this->id, \PDO::PARAM_INT);
        $query->execute();
        $this->data['personal'] = $query->fetch();
    }

    private function getUserTopics()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("SELECT id,title FROM topic WHERE user_id = :id");
        $query->bindValue(':id', $this->id, \PDO::PARAM_INT);
        $query->execute();
        $this->data['topics'] = $query->fetchAll();
    }

}