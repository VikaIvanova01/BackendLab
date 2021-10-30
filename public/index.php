<?php 

require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/CatController.php";
require_once "../controllers/CatImageController.php";
require_once "../controllers/CatInfoController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/DogController.php";
require_once "../controllers/DogImageController.php";
require_once "../controllers/DogInfoController.php";
$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);
$url = $_SERVER["REQUEST_URI"];

$context = [];
$controller = new Controller404($twig);

if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/cat/image#", $url)) { 
    $controller = new CatImageController($twig);
} elseif (preg_match("#^/cat/info#", $url)) {
    $controller = new CatInfoController($twig);
} elseif (preg_match("#^/cat#", $url)) {
    $controller = new CatController($twig);
} elseif (preg_match("#^/dog/image#", $url)) { 
    $controller = new DogImageController($twig);
} elseif (preg_match("#^/dog/info#", $url)) {
    $controller = new DogInfoController($twig);
} elseif (preg_match("#^/dog#", $url)) {
    $controller = new DogController($twig);
}

if ($controller) {
    $controller->get();
}

    