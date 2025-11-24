<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteEditPerso extends Route
{

    private PersoController $persoController;

    public function __construct(PersoController $persoController){

        $this->persoController = $persoController;

    }
    public function get($params = []): void
    {

        $id = $this->getParam($params, "id", false);

        $this->persoController->displayEditPerso();
    }

    public function post($params = []): void
    {
        // Non utilisé
    }
}
