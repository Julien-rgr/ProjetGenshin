<?php

namespace Controllers\Router;

use Controllers\LoginController;
use Controllers\MainController;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddPersoElement;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogs;
use Exception;

class Router
{
    private array $ctrlList = [];
    private array $routeList = [];

    public function __construct()
    {
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Initialise la liste des contrôleurs
     */
    private function createControllerList(): void
    {

        $this->ctrlList = [
            "main"  => new MainController(),


        ];
    }


    private function createRouteList(): void
    {
        $this->routeList = [
            "index"             => new RouteIndex($this->ctrlList["main"]),
            "add-perso"         => new RouteAddPerso($this->ctrlList["main"]),
            "add-perso-element" => new RouteAddPersoElement($this->ctrlList["main"]),
            "login"             => new RouteLogin($this->ctrlList["main"]),
            "logs"              => new RouteLogs($this->ctrlList["main"]),
        ];
    }


    public function routing(array $get, array $post): void
    {
        $action = $get['action'] ?? 'index';

        if (!isset($this->routeList[$action])) {
            throw new Exception("Route '$action' introuvable.");
        }

        /** @var Route $route */
        $route = $this->routeList[$action];

        $method = $_SERVER['REQUEST_METHOD'];
        $params = ($method === 'POST') ? $post : $get;

        $route->action($params, $method);
    }
}
