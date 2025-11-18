<?php

namespace Controllers\Router;

use Controllers\Router\Route\Route;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddPersoElement;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogs;
use Exception;

class Router
{
    private array $routeList = [
        'index'            => RouteIndex::class,
        'add-perso'        => RouteAddPerso::class,
        'add-perso-element'=> RouteAddPersoElement::class,
        'login'            => RouteLogin::class,
        'logs'             => RouteLogs::class,
    ];

    public function routing(array $get, array $post): void
    {
        // Action demandée (par défaut : index)
        $action = $get['action'] ?? 'index';

        // Vérifier si la route existe
        if (!isset($this->routeList[$action])) {
            throw new Exception("Route '$action' introuvable.");
        }

        // On récupère la classe associée à l'action
        $routeClass = $this->routeList[$action];

        // On instancie la Route
        /** @var Route $route */
        $route = new $routeClass();

        // Déterminer la méthode HTTP réelle
        $method = $_SERVER['REQUEST_METHOD'];

        // Paramètres passés à la route :
        // GET si GET, POST si POST
        $params = ($method === 'POST') ? $post : $get;

        // Exécution de l'action via la classe Route
        $route->action($params, $method);
    }
}
