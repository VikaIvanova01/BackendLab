<?php
require_once "BaseController.php";

class TwigBaseController extends BaseController {
    public $title = "";
    public $template = ""; 
    public $menu = [
        [
            "title" => "Главная",
            "url" => "/",
        ],
        [
            "title" => "Всё о котиках",
            "url" => "/cat",
        ],
        [
            "title" => "Всё о собачках",
            "url" => "/dog",
        ]
    ];
    protected \Twig\Environment $twig; 
    
    public function __construct($twig)
    {
        $this->twig = $twig; 
    }
    
    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title; 
        $context['menu'] = $this->menu; 

        return $context;
    }
    
    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }
}