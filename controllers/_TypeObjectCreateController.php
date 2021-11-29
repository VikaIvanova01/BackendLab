<?php
require_once "Base_AnimalTwigController.php";

class AnimalTypeObjectCreateController extends Base_AnimalTwigController
{
    public $template = "animals_type_create.twig";

    public function get(array $context)
    {
        $context['title'] = "Добавление типа животного";

        parent::get($context);
    }

    public function post(array $context)
    {
        $name_t = $_POST['name_t'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        $sql = <<<EOL
INSERT INTO animals_types(name, image)
VALUES(:name_t, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("name_t", $name_t);
        $query->bindValue("image_url", $image_url);
        $query->execute();

        $context['message'] = 'Вы успешно создали тип объекта';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}
