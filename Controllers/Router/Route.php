<?php

namespace Controllers\Router;

use Exception;

abstract class Route
{
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
            if(!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        }
        else {
            throw new Exception("Paramètre '$paramName' absent");
        }
    }

    public abstract function get($params = []);

    public abstract function post($params = []);

}