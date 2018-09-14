<?php
namespace App\Controllers;
use App\Core\View;
class MainController
{
    protected $view;
    public function __construct()
    {
        $this->view = new View();
}