<?php
require_once "TwigBaseController.php"; 

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "Главная";
    public $menu_cat = [
        [
            "title" => "Кошечки",
            "url" => "/cat",
        ],
        [
            "title" => "Картинка",
            "url" => "/cat/image",
        ],
        [
            "title" => "Информация",
            "url" => "/cat/info",
        ]
    ];
    public $menu_dog = [
        [
            "title" => "Собачки",
            "url" => "/dog",
        ],
        [
            "title" => "Картинка",
            "url" => "/dog/image",
        ],
        [
            "title" => "Информация",
            "url" => "/dog/info",
        ]
    ];

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['menu_cat'] = $this->menu_cat; 
        $context['menu_dog'] = $this->menu_dog; 

        return $context;
    }
}