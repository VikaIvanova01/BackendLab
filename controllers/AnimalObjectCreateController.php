<?php
require_once "Base_AnimalTwigController.php";

class AnimalObjectCreateController extends Base_AnimalTwigController
{
    public $template = "animals_create.twig";

    public function get(array $context)
    {
        $context['title'] = "Добавление";

        parent::get($context);
    }

    public function post(array $context)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $info = $_POST['info'];
        $type = $_POST['type'];
 
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO animals_obj(title, image, description, info, type)
VALUES(:title, :image_url, :description, :info, :type)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->bindValue("type", $type);
        $query->execute();

        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}