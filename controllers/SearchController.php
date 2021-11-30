<?php
require_once "Base_AnimalTwigController.php";

class SearchController extends Base_AnimalTwigController
{
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context['title'] = "Поиск";

        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $info = isset($_GET['info']) ? $_GET['info'] : '';

        if (isset($_GET['type'])) {
            $sql = <<<EOL
            SELECT id, title
            FROM animals_obj
            WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
                AND (:info = '' OR info like CONCAT('%', :info, '%'))
                    AND (type like CONCAT('%', :type, '%'))
            EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("info", $info);
            $query->bindValue("type", $type);
            $query->execute();
            $context['objects'] = $query->fetchAll();
        }
        return $context;
    }
}
