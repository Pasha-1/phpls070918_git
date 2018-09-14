<?php
namespace App\Controllers;
use App\Core\Validation;
use App\Models\Autorization;
class Login extends MainController
{
    const RANDOM_LENGTH = 20;
    public function index()
    {
        $loginStatus = false;
        if (!empty($_POST['name'] && !empty($_POST['password']))) {
            $model = new Autorization();
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['salt'=>PASSWORD_SALT]);
            if ($userId = $model->checkUserByPassword(mb_strtolower($_POST['name']), $password)) {
                $hash = bin2hex(random_bytes(self::RANDOM_LENGTH));
                $model->setCookieHash($userId, $hash);
                setcookie('id', $userId, 0, '/');
                setcookie('hash', $hash, 0, '/');
                $loginStatus = true;
            }
        }
        $this->view->render('login/index', 'template', ['loginStatus'=>$loginStatus]);
    }
    public function register()
    {
        $registerStatus = false;
        $errors = [];
        if (!empty($_POST)) {
            $model = new Autorization();
            if (!Validation::checkPasswords($_POST['password'], $_POST['password2'])) {
                $errors[] = Validation::ERROR_DIF_PASSWORDS;
            }
            if (!Validation::checkName($_POST['name'])) {
                $errors[] = Validation::ERROR_NAME;
            }
            if (!Validation::checkAge($_POST['age'])) {
                $errors[] = Validation::ERROR_AGE;
            }
            if (!Validation::checkPassword($_POST['password'])) {
                $errors[] = Validation::ERROR_PASSWORD;
            }
            if (!$errors) {
                if (!$model->checkUserByLowerName(mb_strtolower($_POST['name']))) {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['salt'=>PASSWORD_SALT]);
                    $userId = $model->addNewUser($_POST['name'], $_POST['age'], $password);
                    $hash = bin2hex(random_bytes(self::RANDOM_LENGTH));
                    $model->setCookieHash($userId, $hash);
                    setcookie('id', $userId, 0, '/');
                    setcookie('hash', $hash, 0, '/');
                    $registerStatus = true;
                } else {
                    $errors[] = Validation::ERROR_USER_EXIST;
                }
            }
        }
        $this->view->render('login/register', 'template', ['registerStatus'=>$registerStatus, 'errors'=>$errors]);
    }
}