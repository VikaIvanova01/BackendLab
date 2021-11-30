<?php
require_once "BaseRestController.php";

class AnimalRestController extends BaseRestController
{
    public function retrieve()
    {
        $query = $this->pdo->query("SELECT * FROM animals_obj WHERE id = :id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetchAll();
        header("Content-type: application/json");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function list()
    {
        $query = $this->pdo->query("SELECT id, title FROM animals_obj");
        $query->execute();

        $data = $query->fetchAll();
        header("Content-type: application/json");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function create()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data, True);

        $sql = <<<EOL
INSERT INTO animals_obj(title, image, description, info, type)
VALUES(:title, :image_url, :description, :info, :type)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $data['id']);
        $query->bindValue("type", $this->params['type']);
        $query->bindValue("info", $this->params['info']);
        $query->bindValue("image_url", $this->params['image']);
        $query->bindValue("description", $this->params['description']);
        $query->execute();

        http_response_code(201);
        header("Content-type: application/json");
        echo json_encode(["id" => $this->params['id']]);
    }

    public function update()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data, True);

        $sql = <<<EOL
UPDATE animals_obj
SET title = :title, image = :image_url, description = :description, info = :info, type = :type
WHERE id = :id; 
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $data['id']);
        $query->bindValue("type", $this->params['type']);
        $query->bindValue("info", $this->params['info']);
        $query->bindValue("image", $this->params['image']);
        $query->bindValue("description", $this->params['description']);
        $query->execute();

        http_response_code(204);
        header("Content-type: application/json");
        echo json_encode(["id" => $this->params['id']]);
    }
    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"));
        $data = json_decode($data, True);
        $sql = <<<EOL
DELETE FROM animals_obj WHERE id = :id
EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $this->params['id']);
        $query->execute();

        http_response_code(204);
        header("Content-type: application/json");
    }
}
