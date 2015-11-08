<?php
namespace application\controllers;

use application\models\RegisterModel;
use application\views\View;

class RegController
{
    public function __construct()
    {
        $this->view = new View();
    }
    public static function registerUser ()
    {
        $newUser = new RegisterModel();
        $newUser->realName = $_POST['realName'];
        $newUser->email = $_POST['email'];
        $newUser->password = $_POST['password'];
        $newUser->username = $_POST['username'];
        $newUser->verificationReg();
        return $newUser->message;
    }

    public function actionRegister()
    {
        $data = self::actionRegInput();
        $this->view->generate('RegistrationPage.php', $data);
    }

    public static function actionRegInput(){
        if(isset($_REQUEST['registr'])){
            return self::registerUser();
        }
        return '';
    }

}