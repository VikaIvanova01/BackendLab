<?php
require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/AnimalObjectCreateController.php";
require_once "../controllers/AnimalTypeObjectCreateController.php";
require_once "../controllers/AnimalDeleteController.php";
require_once "../controllers/AnimalObjectUpdateController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=animals;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/animals_obj/(?P<id>\d+)", ObjectController::class);
$router->add("/animals_obj/(?P<id>\d+)/", ObjectController::class);
$router->add("/search", SearchController::class);
$router->add("/animals_obj/create", AnimalObjectCreateController::class);
$router->add("/animals_obj/create_type", AnimalTypeObjectCreateController::class);
$router->add("/animals_obj/(?P<id>\d+)/delete", AnimalDeleteController::class);
$router->add("/animals_obj/(?P<id>\d+)/edit", AnimalObjectUpdateController::class);
$router->get_or_default(Controller404::class);