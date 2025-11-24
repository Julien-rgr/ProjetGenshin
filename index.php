<?php

use Helpers\Psr4AutoloaderClass;
use Controllers\Router\Router;

// Chargement de l'autoload
require_once "Helpers/Psr4AutoloaderClass.php";

$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');
$loader->addNamespace('\Controllers', '/Controllers');
$loader->addNamespace('\Models', '/Models');
$loader->addNamespace('\Config', '/Config');
$loader->addNamespace('\Controllers\Router', '/Controllers/Router');
$loader->addNamespace('\Controllers\Router\Route', '/Controllers/Router/Route');

try {
    // Initialisation du router
    $router = new Router();

    // Lancer le routage
    $router->routing($_GET, $_POST);

} catch (Exception $e) {

    // Templates pour afficher la page error
    $templates = new League\Plates\Engine(__DIR__ . '/Views');

    echo $templates->render('error', [
        'message' => $e->getMessage()
    ]);
}
