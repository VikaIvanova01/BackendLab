<?php

require_once "Base_AnimalTwigController.php";

class ObjectController extends Base_AnimalTwigController
{
    public $template = "objectContent.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $chose = "";

        if (isset($_GET['show'])) {
            $context['show'] = $_GET['show'];
            if ($_GET['show'] == "image") {
                $query = $this->pdo->prepare("SELECT id, image, title FROM animals_obj WHERE id= :my_id");
                $chose = "image";
            } elseif ($_GET['show'] == "info") {
                $query = $this->pdo->prepare("SELECT id, info, title FROM animals_obj WHERE id= :my_id");
                $chose = "info";
            }
        } else {
            $query = $this->pdo->prepare("SELECT id, description, title FROM animals_obj WHERE id= :my_id");
        }
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        $context['title'] = $data['title'];
        $context['chose'] = $chose;
        $context['object'] = $data;
        // $context["my_session_message"] = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : "";
        // $context["messages"] = isset($_SESSION['messages']) ? $_SESSION['messages'] : "";
        // $context["history"] = isset($_SESSION['history']) ? $_SESSION['history'] : "";
        return $context;
    }
}