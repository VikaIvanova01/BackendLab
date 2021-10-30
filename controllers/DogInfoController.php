<?php
require_once "DogController.php";

class DogInfoController extends DogController {
    public $template = "dog_info.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 


        return $context;
    }
}