<?php

namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteIndex extends Route
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
     * Affiche la page d'accueil.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $this->controller->index();
    }

    /**
     * Affiche la page d'accueil lors d'une requête POST.
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
        $this->controller->index();
    }
}
