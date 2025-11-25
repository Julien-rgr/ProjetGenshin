<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteDetailPerso extends Route
{
    private PersoController $persoController;

    public function __construct(PersoController $persoController)
    {
        parent::__construct();
        $this->persoController = $persoController;
    }

    public function get($params = []): void
    {
        $id = $this->getParam($params, "id", false);
        $this->persoController->displayDetail($id);
    }

    public function post($params = []): void
    {
        // inutile
    }
}
