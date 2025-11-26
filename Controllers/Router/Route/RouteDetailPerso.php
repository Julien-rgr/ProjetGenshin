<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteDetailPerso extends Route
{
    private PersoController $persoController;

    /**
     * @param PersoController $persoController
     */
    public function __construct(PersoController $persoController)
    {
        parent::__construct();
        $this->persoController = $persoController;
    }

    /**
     * Affiche la page de détail d’un personnage à partir de son ID.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $id = $this->getParam($params, "id", false);
        $this->persoController->displayDetail($id);
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
