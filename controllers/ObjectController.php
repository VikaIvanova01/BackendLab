<?php
require_once "TwigBaseController.php"; 

class ObjectController extends TwigBaseController {
    public $template = "object.twig";
    public $images = [];
    public $url_image = "";
    public $url_info = "";

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['images'] = $this->images; 
        $context['url_image'] = $this->url_image; 
        $context['url_info'] = $this->url_info; 

        return $context;
    }
    
}