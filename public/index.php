<?php
//путь
define('APPLICATION_PATH', getcwd().'/../app/');
//config
require_once APPLICATION_PATH . 'Core/config.php';
//psr-4
require_once APPLICATION_PATH . 'vendor/autoload.php';
//запрос
$routes = explode('/', $_SERVER['REQUEST_URI']);
//контроллер
$controllerName = "Main";
$actionName = 'index';
$parametres = [];
foreach ($routes as $routeKey => $routeVal) {
    if ($routeVal) {
        switch ($routeKey) {
            case '0':
                break;
            case '1':
                $controllerName = $routeVal;
                break;
            case '2':
                $actionName = $routeVal;
                break;
            default:
                $parametres[] = $routeVal;
        }
    }
}
print_r($controllerName);
print_r($actionName);
print_r($parametres);
try {
    $classname = "App\Controllers\\" . ucfirst($controllerName);
    if (class_exists($classname)) {
        $controller = new $classname();
    } else {
        throw new Exception("Класс отсутсвует");
    }
    if (method_exists($controller, $actionName)) {
        $controller->$actionName($parametres);
    } else {
        throw new Exception("Метод класса отсутсвует");
    }
} catch (Exception $e) {
    require APPLICATION_PATH . "errors/showError404.php";
}