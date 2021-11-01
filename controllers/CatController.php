<?php
require_once "ObjectController.php"; 

class CatController extends ObjectController {
    public $template = "object.twig";
    public $title = "Всё о котиках";
    public $images = [
        "/images/cat.jpg",
        "/images/cat1.jpg",
        "/images/cat2.jpg",
        "/images/cat3.jpg",
    ];
    public $url_image = "/cat/image";
    public $url_info = "/cat/info";
    
    public function getContext() : array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['is_image'] = $context['url'] == "/cat/image";
        $context['is_info'] = $context['url'] == "/cat/info";
        $context['url_image'] = "/cat/image";
        $context['url_info'] = "/cat/info";
        return $context;
    }
}