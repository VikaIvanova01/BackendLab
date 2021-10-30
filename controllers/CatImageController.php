<?php
require_once "CatController.php"; 

class CatImageController extends CatController {
    public $template = "image.twig";
    
    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        return $context;
    }

}