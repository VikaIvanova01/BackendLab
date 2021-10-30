<?php
require_once "DogController.php"; 

class DogImageController extends DogController {
    public $template = "image.twig";
    
    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        return $context;
    }

}