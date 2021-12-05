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
require_once "../controllers/AnimalRestController.php";
require_once "../middlewares/LoginRequiredMiddleware.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=animals;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/animals_obj/(?P<id>\d+)", ObjectController::class);
$router->add("/animals_obj/(?P<id>\d+)/", ObjectController::class);
$router->add("/search", SearchController::class);
$router->add("/animals_obj/create", AnimalObjectCreateController::class)
        ->middleware(new LoginRequiredMiddleware());
$router->add("/animals_obj/create_type", AnimalTypeObjectCreateController::class)
        ->middleware(new LoginRequiredMiddleware());
$router->add("/animals_obj/(?P<id>\d+)/delete", AnimalDeleteController::class)
        ->middleware(new LoginRequiredMiddleware());
$router->add("/animals_obj/(?P<id>\d+)/edit", AnimalObjectUpdateController::class)
        ->middleware(new LoginRequiredMiddleware());
$router->add("/api/animals/(?P<id>\d+)?", AnimalRestController::class);
$router->get_or_default(Controller404::class);