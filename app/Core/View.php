<?php
namespace App\Core;
class View
{
    public function render(string $contentView, string $templateView, array $data)
    {
        $content = APPLICATION_PATH . "Views/" . $contentView . ".php";
        $template = APPLICATION_PATH . "Views/" . $templateView . ".php";
        try {
            if (!file_exists($content)) {
                throw new \Exception("Вид отсутсвует");
            }
            if (!file_exists($template)) {
                throw new \Exception("Шаблон отсутсвует");
            } else {
                extract($data); // импортируем переменные из массива в текущую таблицу
                require_once $template;
            }
        } catch (\Exception $e) {
            require APPLICATION_PATH . "errors/showError404.php";
        }
    }
}