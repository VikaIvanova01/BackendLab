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

        if (isset($_POST['title']) || isset($_POST['description']) || isset($_POST['type']) || isset($_POST['info'])) {
                $sql = <<<EOL
UPDATE animals_obj
SET title = :title, description = :description, info = :info, type = :type
WHERE id = :id;
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type", $type);
            $query->bindValue("info", $info);
            $query->bindValue("id", $id);
            $query->execute();

            $context['message'] = 'Вы успешно обновили объект';
        }
        $this->get($context);
    }
}