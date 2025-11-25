<?php

namespace Controllers\Router\Route;

use Controllers\ElementController;
use Controllers\Router\Route;

class RouteAddPersoElement extends Route
{
    private ElementController $elementController;

    public function __construct(ElementController $elementController)
    {
        $this->elementController = $elementController;
    }

    /**
     * GET → afficher le formulaire d’ajout
     */
    public function get($params = []): void
    {
        $this->elementController->displayAddElement();
    }

    /**
     * POST → traiter l’ajout
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

            // Réaffiche le formulaire avec le message d’erreur
            $this->elementController->displayAddElement($e->getMessage());
        }
    }
}
