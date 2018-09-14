<?php
namespace App\Models;
use \App\Core\Connection;
class MainModel
{
    protected $dbConnection;
    public function __construct()
    {
        $this->dbConnection = Connection::getInstance();
    }
}