<?php

namespace Controllers\Router;

use Controllers\Router\Route\Route;
use Controllers\MainController;

class RouteIndex extends Route
{
    private MainController $controller;

    public function __construct()
    {

        $this->controller = new MainController();
    }

    public function get($params = []): void
    {

        $this->controller->index();
    }

    public function post($params = []): void
    {

        $this->controller->index();
    }
}
