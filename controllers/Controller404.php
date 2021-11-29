<?php
require_once "Base_AnimalTwigController.php";

class Controller404 extends Base_AnimalTwigController {
    public $template = "404.twig"; 
    public $title = "Страница не найдена";

    public function get(array $context)
    {
        http_response_code(404); 
        parent::get($context);
    }
}