<?php
require_once "Base_AnimalTwigController.php";

class AnimalObjectUpdateController extends Base_AnimalTwigController
{
    public $template = "animals_create.twig";

    public function get(array $context)
    {
        $context['title'] = "Редактирование";
        $id = $this->params['id'];
        $sql = <<<EOL
SELECT * FROM animals_obj WHERE id = :id
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();

        $data = $query->fetch();

        $context['object'] = $data;

        parent::get($context);
    }

    public function post(array $context)
    {
        $id = $this->params['id'];
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }
        if (isset($_POST['description'])) {
            $description = $_POST['description'];
        }
        if (isset($_POST['type'])) {
            $type = $_POST['type'];
        }
        if (isset($_POST['info'])) {
            $info = $_POST['info'];
        }
        if (isset($_FILES['image'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name =  $_FILES['image']['name'];

            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        }

        if (isset($_POST['title']) || isset($_POST['description']) || isset($_POST['type']) || isset($_POST['info'])) {
            if ($_FILES['image']) {
                $sql = <<<EOL
UPDATE animals_obj
SET title = :title, image = :image_url, description = :description, info = :info, type = :type
WHERE id = :id;
EOL;
            } else {
                $sql = <<<EOL
UPDATE animals_obj
SET title = :title, description = :description, info = :info, type = :type
WHERE id = :id;
EOL;
            }
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type", $type);
            $query->bindValue("info", $info);
            $query->bindValue("id", $id);
            if ($_FILES['image']) {
                $query->bindValue("image_url", $image_url);
            }
            $query->execute();

            $context['message'] = 'Вы успешно обновили объект';
        }
        $this->get($context);
    }
}