<?php
namespace App\Core;
use \App\Models\Autorization as AutorizationModel;
class Autorization
{
    public static function getLoggedUserId()
    {
        $model = new AutorizationModel();
        if (!isset($_COOKIE['id']) || !isset($_COOKIE['hash'])) {
            return false;
        }
        $result = $model->checkUserByCookieHash($_COOKIE['id'], $_COOKIE['hash']);
        if (!$result) {
            return false;
        }
        return $result; //откат user id
    }
}