<?php
namespace application\models;

use application\additionally\Connection;

class UserModel
{
    public $username;
    public $password;
    public $message;
    public $arr;
    public function checkLoginData()
    {
        $this->getDataArr();
        switch (false) {
            case $this->checkUser(): break;
            case $this->checkUserPassword(): break;
            default:
                $this->message = '';
                return true;
        }
        return false;
    }

    private function getDataArr()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare('SELECT * FROM users WHERE username = :username');
        $query->bindValue(':username', $this->username, \PDO::PARAM_STR);
        $query->execute();
        $this->arr = $query->fetch();
    }


    public function getHash()
    {
        $salt1 = "#%LOMAI%)";
        $salt2 = "&POlˆosty(u";
        $this->password = hash('ripemd128', $salt1 . $this->password . $salt2);
    }

    private function checkUser()
    {
        if(empty($this->arr)) {
            $this->message = 'Пользователя с логином ' . $this->username . ' ,к сожалению, пока нет';
            return FALSE;
        }
        return TRUE;
    }

    private function checkUserPassword()
    {
        $this->getHash();
        $password = $this->arr['password'] ;
        if($password != $this->password) {
            $this->message = 'Неверный пароль';
            return FALSE;
        }
        return TRUE;
    }
}