<?php

namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteIndex extends Route
{
   private MainController $controller;

    public function __construct(MainController $controller)
    {

        $this->controller = $controller;
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
