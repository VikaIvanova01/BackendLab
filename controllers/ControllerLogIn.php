<?php
require_once "Base_AnimalTwigController.php";

class ControllerLogin extends Base_AnimalTwigController {
    public $template = "login.twig";
    public $title = "Login";

    public function post(array $context)
    {
        $_SESSION['is_logged'] = false;
        $user = $_POST['login'];
        $password = $_POST['password'];        
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $query->bindValue("username", $user);
        $query->bindValue("password", $password);
        $query->execute(); 
        $data = $query->fetch();
        if ($data) {
            $_SESSION["is_logged"] = true;
            $url = $_SERVER['HTTP_REFERER'];
            header("Location: /");
        } 
        $context['message'] = 'Неверный логин или пароль';
        $this->get($context);
    }
}