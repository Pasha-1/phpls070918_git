<?php
namespace App\Core;
class Connection
{
    private static $instance;
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new \PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
            } catch (\Exception $e) {
                throw new \Exception("Ошибка подключения к базе данных");
            }
        }
        return self::$instance;
    }
    protected function __construct()
    {
        //
    }
    public function __clone()
    {
        //
    }
    public function __wakeup()
    {
        //
    }
}