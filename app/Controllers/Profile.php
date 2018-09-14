<?php
namespace App\Controllers;
use App\Core\Upload;
use App\Core\Validation;
use \App\Models\User;
use \App\Models\File;
use \App\Core\Autorization;
use \App\Models\Autorization as AutorizationModel;
class Profile extends MainController
{
    const IMG_DIR = 'img';
    const IMG_PROFILE_DIR = 'profiles';
    const IMG_FILES_DIR = 'files';
    public function index()
    {
        if (!$userId = Autorization::getLoggedUserId()) {
            $this->view->render('nologged', 'template', []);
            return false;
        };
        $model = new User();
        $data = $model->getUserDataById($userId);
        $fileModel = new File();
        $fileData = $fileModel->getFilesById($userId);
        $this->view->render('profile/index', 'template', [
            'userInfo'=>$data,
            'userId'=>$userId,
            'fileData'=>$fileData
        ]);
    }
    public function addfile()
    {
        if (!$userId = Autorization::getLoggedUserId()) {
            $this->view->render('nologged', 'template', []);
            return false;
        };
        $model = new File();
        $errors = [];
        if (!empty($_FILES['document']['name'])) {
            /* Путь */
            if (!file_exists($path = self::IMG_DIR)) {
                mkdir($path);
            }
            if (!file_exists($path = self::IMG_DIR . '/'  . self::IMG_FILES_DIR)) {
                mkdir($path);
            }
            if (!file_exists($path = self::IMG_DIR . '/'  . self::IMG_FILES_DIR . '/' . $userId)) {
                mkdir($path);
            }
            $imgUploader = new Upload();
            $imgUploader->setDestination($path);
            $imgUploader->setMaxSize('5242880');
            $imgUploader->setAllowedExtensions(['jpg', 'jpeg', 'png', 'doc', 'csv', ]);
            $imgUploader->setAllowedMimeTypes([
                'image/jpeg',
                'image/png',
                'application/msword',
                'text/csv',
                'text/plain'
            ]);
            $uploadStatus = $imgUploader->upload($_FILES['document']);
            if ($uploadStatus['status']) {
                $model->addImg($userId, $uploadStatus['filename']);
            } else {
                $errors[] = $uploadStatus['error'];
            }
        }
        $fileData = $model->getFilesById($userId);
        $this->view->render('profile/addfile', 'template', [
            'userId'=>$userId,
            'fileData'=>$fileData,
            'errors'=>$errors
        ]);
    }
    public function edit()
    {
        if (!$userId = Autorization::getLoggedUserId()) {
            $this->view->render('nologged', 'template', []);
            return false;
        };
        $model = new User();
        $autorizationModel = new AutorizationModel;
        $errors = [];
        /* Проверка загрузкb аватара */
        if (!empty($_FILES['logo']['name'])) {
            /* Путь */
            if (!file_exists($path = self::IMG_DIR)) {
                mkdir($path);
            }
            if (!file_exists($path = self::IMG_DIR . '/'  . self::IMG_PROFILE_DIR)) {
                mkdir($path);
            }
            if (!file_exists($path = self::IMG_DIR . '/'  . self::IMG_PROFILE_DIR . '/' . $userId)) {
                mkdir($path);
            }
            $imgUploader = new Upload();
            $imgUploader->setDestination($path);
            $imgUploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
            $imgUploader->setAllowedMimeTypes(['image/jpeg', 'image/png']);
            $uploadStatus = $imgUploader->upload($_FILES['logo']);
            if ($uploadStatus['status']) {
                $model->updateImg($userId, $uploadStatus['filename']);
            } else {
                $errors[] = $uploadStatus['error'];
            }
        }
        /* Tекстовыe данныe формы */
        $pageUpdate = false;
        if (!empty($_POST)) {
            if (!Validation::checkName($_POST['name'])) {
                $errors[] = Validation::ERROR_NAME;
            }
            if (!Validation::checkAge($_POST['age'])) {
                $errors[] = Validation::ERROR_AGE;
            }
            if (!$errors) {
                //есть ли пользователь с таким именем
                $checkUserByLowerName = $autorizationModel->checkUserByLowerName($_POST['name']);
                if (!$checkUserByLowerName || $checkUserByLowerName==$userId) {
                    $pageUpdate = $model->updateUserDataById(
                        $userId,
                        $_POST['name'],
                        $_POST['age'],
                        $_POST['description']
                    );
                } else {
                    $errors[] = Validation::ERROR_USER_EXIST;
                }
            }
        }
        $data = $model->getUserDataById($userId);
        $this->view->render('profile/edit', 'template', [
            'userInfo'=>$data,
            'userId'=>$userId,
            'pageUpdate'=>$pageUpdate,
            'errors'=>$errors
        ]);
    }
}