<?php
require_once "Base_AnimalTwigController.php";

class ControllerLogOut extends Base_AnimalTwigController {

    public function get(array $context){
        $_SESSION["is_logged"] = false;
        header('Location: /login');
        exit; 
    }
}