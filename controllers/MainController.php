<?php
require_once "Base_AnimalTwigController.php";

class MainController extends Base_AnimalTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT * FROM animals_obj");

        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM animals_obj WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
            $context['title'] = $_GET['type'];
        } else {
            $query = $this->pdo->query("SELECT * FROM animals_obj");
        }

        $context['animals_obj'] = $query->fetchAll();
        return $context;
    }

    
}