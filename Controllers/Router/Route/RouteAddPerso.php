<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteAddPerso extends Route
{
    private PersoController $persoController;

    /**
     * @param PersoController $persoController
     */
    public function __construct(PersoController $persoController)
    {
        parent::__construct();
        $this->persoController = $persoController;
    }

    /**
     * Affiche le formulaire d’ajout de personnage.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $this->persoController->displayAddPerso();
    }

    /**
     * Traite l’ajout d’un personnage après soumission du formulaire.
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
        try {
            $data = [
                "name"      => $this->getParam($params, "name", false),
                "image"     => $this->getParam($params, "image", false),
                "element"   => $this->getParam($params, "element", false),
                "unitclass" => $this->getParam($params, "unitclass", false),
                "origin"    => $params["origin"] ?? "",
                "rarity"    => $this->getParam($params, "rarity", false),
            ];

            $this->persoController->addPerso($data);

        } catch (\Exception $e) {
            $this->persoController->displayAddPerso($e->getMessage());
        }
    }
}
