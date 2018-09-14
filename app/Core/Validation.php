<?php
namespace App\Core;
class Validation
{
    const MAX_AGE = 99;
    const MIN_AGE = 1;
    const ERROR_NAME = 'Имя - строка 3-21 символов (A-Z a-z А-Я а-я 0-9 - _)';
    const ERROR_PASSWORD = 'Пароль - строка 4-63 символов (A-Z a-z 0-9 ! @ # $ & *)';
    const ERROR_AGE = 'Укажите корректный возраст';
    const ERROR_USER_EXIST = 'Пользователь с таким именем уже существует';
    const ERROR_DIF_PASSWORDS = 'Пароли не совпадают';
    public static function checkName($name)
    {
        $pattern = '/^[A-Za-zа-яА-ЯёЁ0-9-_]{3,21}$/';
        if (!preg_match($pattern, $name)) {
            return false;
        }
        return true;
    }
    public static function checkPassword($password)
    {
        $pattern = '/^[a-zA-Z0-9!@#$&*]{4,63}$/';
        if (!preg_match($pattern, $password)) {
            return false;
        }
        return true;
    }
    public static function checkAge($age)
    {
        if ($age > self::MAX_AGE || $age < self::MIN_AGE) {
            return false;
        }
        return true;
    }
    public static function checkPasswords($password1, $password2)
    {
        if ($password1 != $password2) {
            return false;
        }
        return true;
    }
}