<?php
require_once "ObjectController.php"; 

class DogController extends ObjectController {
    public $template = "object.twig";
    public $title = "Всё о собачках";
    public $images = [
        "/images/dog.jpg",
        "/images/dog1.jpg",
        "/images/dog2.jpg",
        "/images/dog3.jpg",
    ];
    public $url_image = "/dog/image";
    public $url_info = "/dog/info";

    public function getContext() : array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['is_image'] = $context['url'] == "/dog/image";
        $context['is_info'] = $context['url'] == "/dog/info";
        $context['url_image'] = "/dog/image";
        $context['url_info'] = "/dog/info";
        return $context;
    }
}