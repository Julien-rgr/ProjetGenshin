<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteLogin extends Route
{
    private MainController $controller;

    /**
     * @param MainController $controller
     */
    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Affiche la page de connexion.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $this->controller->displayLogin();
    }

    /**
     * Traitement d’un éventuel POST de connexion.
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
    }
}
