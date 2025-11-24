<?php

namespace Controllers\Router\Route;

use Controllers\ElementController;
use Controllers\Router\Route;

class RouteAddPersoElement extends Route
{

    private ElementController $elementController;

    public function __construct(ElementController $elementController){

        $this->elementController = $elementController;

    }
    public function get($params = []): void
    {
        $this->elementController->displayAddElement();
    }

    public function post($params = []): void
    {
    }
}
