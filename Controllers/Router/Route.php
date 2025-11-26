<?php

namespace Controllers\Router;

use Exception;

abstract class Route
{
    protected \League\Plates\Engine $templates;

    /**
     * Initialise le moteur de templates.
     */
    public function __construct()
    {
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../../Views');
    }

    /**
     * Exécute la méthode GET ou POST selon la requête HTTP.
     *
     * @param array  $params Paramètres reçus (GET ou POST)
     * @param string $method Méthode HTTP (GET/POST)
     * @return void
     */
    public function action($params = [], $method = 'GET'): void
    {
        if (strtoupper($method) === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    /**
     * Récupère un paramètre dans un tableau, avec validation.
     *
     * @param array  $array        Le tableau source (GET ou POST)
     * @param string $paramName    Nom du paramètre
     * @param bool   $canBeEmpty   Indique si la valeur peut être vide
     * @return mixed
     * @throws Exception Si le paramètre est absent ou invalide
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        }
        throw new Exception("Paramètre '$paramName' absent");
    }

    /**
     * Méthode exécutée pour les requêtes GET.
     *
     * @param array $params
     * @return void
     */
    public abstract function get($params = []);

    /**
     * Méthode exécutée pour les requêtes POST.
     *
     * @param array $params
     * @return void
     */
    public abstract function post($params = []);
}
