<?php
namespace App\Controllers;
use App\Core\Validation;
use App\Models\Autorization;
use App\Models\File;
use App\Models\User;
class Main extends MainController
{
    const DEFAULT_PASSWORD = 12345;
    const COUNT_FAKE_USERS = 20;
    public function index()
    {
        echo 'Это главная страница и основной контроллер. ';
        echo 'Перейти к <a href="/main/test">Tестовая страница MVC</a>.';
        echo '<br><br>';
    }
    public function test()
    {
        $this->view->render('test', 'template', ['project'=>'mvc', 'date'=>'06 2018']);
    }
    public function faker()
    {
        $autorizationModel = new Autorization();
        $userModel = new User();
        $fileModel = new File();
        $faker = \Faker\Factory::create();
        for ($userIter = 1; $userIter <= self::COUNT_FAKE_USERS; $userIter++) {
            /* добавить юзера */
            $userName = $faker->userName;
            $age = $faker->numberBetween(Validation::MIN_AGE, Validation::MAX_AGE);
            $description = $faker->text(255);
            $password = password_hash(self::DEFAULT_PASSWORD, PASSWORD_DEFAULT, ['salt'=>PASSWORD_SALT]);
            $userId = $autorizationModel->addNewUser($userName, $age, $password);
            $userModel->updateUserDataById($userId, $userName, $age, $description);
            if (!file_exists($path = Profile::IMG_DIR)) {
                mkdir($path);
            }
            if (!file_exists($path = Profile::IMG_DIR . '/'  . Profile::IMG_PROFILE_DIR)) {
                mkdir($path);
            }
            if (!file_exists($path = Profile::IMG_DIR . '/'  . Profile::IMG_PROFILE_DIR . '/' . $userId)) {
                mkdir($path);
            }
            $logo = $faker->image($path, 640, 480, 'cats', false);
            $userModel->updateImg($userId, $logo);
             
            if (!file_exists($path = Profile::IMG_DIR . '/'  . Profile::IMG_FILES_DIR . '/' . $userId)) {
                mkdir($path);
            }
            $filesCount = $faker->numberBetween(2, 4);
            for ($iter = 1; $iter <= $filesCount; $iter++) {
                $file = $faker->image($path, 640, 480, 'cats', false);
                $fileModel->addImg($userId, $file);
            }
            echo 'Добавлен пользователь ' . $userName;
            echo ' добавленных документов - ' . $filesCount;
            echo ' пароль для входа - ' . self::DEFAULT_PASSWORD;
            echo '<br>';
        }
    }
}