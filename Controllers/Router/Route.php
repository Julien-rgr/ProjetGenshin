<?php

namespace Controllers\Router;

use Exception;

abstract class Route
{
    protected \League\Plates\Engine $templates;

    public function __construct()
    {
        // __DIR__ = Controllers/Router
        // On remonte jusqu’à /Views
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../../Views');
    }

    public function action($params = [], $method = 'GET'): void
    {
        if (strtoupper($method) === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true) {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        }
        throw new Exception("Paramètre '$paramName' absent");
    }

    public abstract function get($params = []);
    public abstract function post($params = []);
}
