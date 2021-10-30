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

}