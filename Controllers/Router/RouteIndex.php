<?php

namespace Controllers\Router;

use Controllers\Router\Route\Route;
use Controllers\MainController;

class RouteIndex extends Route
{
    private MainController $controller;
    public function __construct($controller){
        $this->controller = $controller;

    }
    public function get($params = [])
    {
        $this->controller->index();
    }

    public function post($params = [])
    {
        $this->controller->index();
    }
}