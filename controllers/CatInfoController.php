<?php
require_once "CatController.php";

class CatInfoController extends CatController {
    public $template = "cat_info.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 


        return $context;
    }
}