<?php

namespace Controllers\Router\Route;

use Controllers\ElementController;
use Controllers\Router\Route;

class RouteAddPersoElement extends Route
{
    private ElementController $elementController;

    /**
     * @param ElementController $elementController
     */
    public function __construct(ElementController $elementController)
    {
        $this->elementController = $elementController;
    }

    /**
     * Affiche le formulaire d’ajout d’un élément / classe / origine.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $this->elementController->displayAddElement();
    }

    /**
     * Traite la création d’un nouvel élément (élément / classe / origine).
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
        try {
            $data = [
                "name"  => $this->getParam($params, "name", false),
                "image" => $this->getParam($params, "image", false),
                "type"  => $this->getParam($params, "type", false),
            ];

            $this->elementController->addElement($data);

        } catch (\Exception $e) {
            $this->elementController->displayAddElement($e->getMessage());
        }
    }
}
