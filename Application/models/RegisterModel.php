<?php
namespace application\models;

use application\additionally\Connection;

class RegisterModel
{
    public $username;
    public $password;
    public $email;
    public $message;
    public $realName;

    public function verificationReg ()
    {
        switch (false) {
            case $this->checkDataUserName(): break;
            case $this->checkRealName(): break;
            case $this->checkData(): break;
            case $this->checkUsername(): break;
            case $this->checkPassword(): break;
            case $this->emailValidation(): break;
            default:
                $this->insertUser();
        }
        return $this->message;
    }
    public function checkData()
    {
        if (empty($this->password) || empty($this->email) || empty($this->username)) {
            $this->message = 'Ну не все же опять ввел ( ͠° ͟ʖ ͡° )(ง ͠° ͟ل͜ ͡°)ง';
            return false;
        }
        else return true;
    }
    public function checkDataUserName()
    {
        if(empty($this->realName)) {
            $this->message = 'Мб хоть имя введешь? Введи все, не то иди в свой двор ( ͠° ͟ʖ ͡°)';
            return false;
        }
        return TRUE;
    }
    public function insertUser ()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare("INSERT INTO users(username, password, email, realname) VALUES (:username, :password, :email, :realName)");
        $query->bindParam(':username', $this->username, \PDO::PARAM_STR);
        $query->bindParam(':password', $this->password, \PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, \PDO::PARAM_STR);
        $query->bindParam(':realName', $this->realName, \PDO::PARAM_STR);
        $query->execute();
        $this->message = $this->username . ', вы успешно зарегистрировались.<br> Сейчас вы переместитесь на другую страницу. ( ͡° ͜ʖ ͡°)';
        echo'<script language="JavaScript">
                setTimeout(\'window.location.href = "/"\', 3000)
             </script>';
    }

    public function getHash ()
    {
        $salt1 = "#%LOMAI%)";
        $salt2 = "&POlˆosty(u";
        $this->password = hash('ripemd128', $salt1 . $this->password . $salt2);
    }
    public function checkUsername ()
    {
        $connection = Connection::getConnection();
        $query = $connection->prepare('SELECT username FROM users WHERE username = :username');
        $query->bindParam(':username', $this->username, \PDO::PARAM_STR);
        $query->execute();
        $row_count = $query->fetch();
        if($row_count==0) {
            return TRUE;
        }
        $this->message = 'Вообще тут уже есть тело под логином ' . $this->username . ',  ┌( ಠ‿ಠ)┘, придумай чего-нибудь другое (｡◕‿◕｡)';
        return false;
    }

    public function emailValidation()
    {
        if(preg_match('/[\w]+@[\w]+\.[a-zA-Z]{2,6}/',$this->email))
            return true;
        $this->message = 'Мыло нормальное напиши { ͡• ͜ʖ ͡•}';
        return false;
    }

    public function checkPassword()
    {
        if (strlen($this->password)>=8){
            $this->getHash();
            return true;
        }
        $this->message = 'Ну короткий же пасс, хочешь чтоб ломанули? { ͡• ͜ʖ ͡•}';
        return false;
    }

    public function checkRealName()
    {
        if(preg_match('/[а-яa-z]{2,30}/i',$this->realName))
            return true;
        $this->message = 'Имя нормальное напиши { ͡• ͜ʖ ͡•}';
        return false;
    }
}
