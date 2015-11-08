<?php
namespace application\controllers;

use application\models\UserModel;

class UserController
{
    public static function loginUser()
    {
        $model = new UserModel();
        $model->username = $_POST['userLogin'];
        $model->password = $_POST['userPassword'];
        if($model->checkLoginData()) {
            $_SESSION['username'] = $model->username;
            $_SESSION['email'] = $model->arr['email'];
            $_SESSION['id'] = $model->arr['id'];
            $_SESSION['realname'] = $model->arr['realname'];
            unset($model);
        }

    }

    public static function getLoginView()
    {
        self::inputControl();
        if(!empty($_SESSION['username'])) {
            return 'authorizedView.php';
        }
        else return 'LoginView.php';
    }

    public static function inputControl()
    {
        if(isset($_POST['getOut'])) {
            unset($_SESSION);
            session_destroy();
        }
        elseif(isset($_POST['enter'])){
            self::loginUser();
        }
    }
}