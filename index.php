<?php

use Controllers\MainController;
use Helpers\Psr4AutoloaderClass;
use Models\PersonnageDAO;

require_once "Helpers/Psr4AutoloaderClass.php";
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');
$loader->addNamespace('\Controllers', '/Controllers');
$loader->addNamespace('\Models', '/Models');
$loader->addNamespace('\Config', '/Config');
$plate = new \League\Plates\Engine(__DIR__.DIRECTORY_SEPARATOR.'Views');
$mainController = new MainController($plate);
$mainController->index();

$testDAO = new PersonnageDAO();
var_dump($testDAO->getAll());
var_dump($testDAO->getbyId(1));
var_dump($testDAO->getbyId(2));

