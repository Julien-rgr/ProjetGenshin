<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteDelPerso extends Route
{
    private PersoController $persoController;

    /**
     * @param PersoController $persoController
     */
    public function __construct(PersoController $persoController)
    {
        $this->persoController = $persoController;
    }

    /**
     * Supprime un personnage en fonction de son ID passé en paramètre GET.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $id = $this->getParam($params, "id", false);
        $this->persoController->deletePerso($id);
    }

    /**
     * Méthode POST non utilisée pour cette route.
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
    }
}
