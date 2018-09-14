<?php
namespace App\Controllers;
use \App\Models\User;
use \App\Core\Autorization;
class Information extends MainController
{
    public function index($parametres)
    {
        if (!Autorization::getLoggedUserId()) {
            $this->view->render('nologged', 'template', []);
            return false;
        };
        $model = new User();
        $data = $model->getAgeUsersInfo($parametres[0]);
        $this->view->render('information/index', 'template', ['usersInfo'=>$data]);
    }
}