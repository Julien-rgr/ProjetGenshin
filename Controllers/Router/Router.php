<?php

namespace Controllers\Router;

use Controllers\ElementController;
use Controllers\MainController;
use Controllers\PersoController;
use Controllers\LogsController;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddPersoElement;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteDetailPerso;
use Exception;

class Router
{
    private array $ctrlList = [];
    private array $routeList = [];

    /**
     * Initialise les contrôleurs et les routes.
     */
    public function __construct()
    {
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Analyse la requête et exécute la route correspondante.
     *
     * @param array $get   Paramètres GET
     * @param array $post  Paramètres POST
     * @return void
     * @throws Exception
     */
    public function routing(array $get, array $post): void
    {
        $action = $get['action'] ?? 'index';

        if (!isset($this->routeList[$action])) {
            throw new Exception("Route '$action' introuvable.");
        }

        $route  = $this->routeList[$action];
        $method = $_SERVER['REQUEST_METHOD'];
        $params = ($method === 'POST') ? $post : $get;

        $route->action($params, $method);
    }

    private function createControllerList(): void
    {
        $views = new \League\Plates\Engine(__DIR__ . '/../../Views');

        $this->ctrlList = [
            "main"    => new MainController($views),
            "perso"   => new PersoController($views),
            "element" => new ElementController($views),
            "logs"    => new LogsController($views),
        ];
    }

    private function createRouteList(): void
    {
        $this->routeList = [
            "index"             => new RouteIndex($this->ctrlList["main"]),
            "add-perso"         => new RouteAddPerso($this->ctrlList["perso"]),
            "add-perso-element" => new RouteAddPersoElement($this->ctrlList["element"]),
            "login"             => new RouteLogin($this->ctrlList["main"]),
            "logs"              => new RouteLogs($this->ctrlList["logs"]),
            "edit-perso"        => new RouteEditPerso($this->ctrlList["perso"]),
            "del-perso"         => new RouteDelPerso($this->ctrlList["perso"]),
            "detail-perso"      => new RouteDetailPerso($this->ctrlList["perso"]),
        ];
    }
}
