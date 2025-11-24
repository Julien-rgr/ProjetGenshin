<?php

namespace Controllers\Router;

use Controllers\ElementController;
use Controllers\MainController;
use Controllers\PersoController;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddPersoElement;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteEditPerso;
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
            "main"  => new MainController(new \League\Plates\Engine(__DIR__ . '/../../Views')),
            "perso" => new PersoController(new \League\Plates\Engine(__DIR__ . '/../../Views')),
            "element" => new ElementController(new \League\Plates\Engine(__DIR__ . '/../../Views')),


        ];
    }


    private function createRouteList(): void
    {
        $this->routeList = [
            "index"             => new RouteIndex($this->ctrlList["main"]),
            "add-perso"         => new RouteAddPerso($this->ctrlList["perso"]),
            "add-perso-element" => new RouteAddPersoElement($this->ctrlList["element"]),
            "login"             => new RouteLogin($this->ctrlList["main"]),
            "logs"              => new RouteLogs($this->ctrlList["main"]),
            "edit-perso"        => new RouteEditPerso($this->ctrlList["perso"]),
            "del-perso"         => new RouteDelPerso($this->ctrlList["perso"]),
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
