<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteEditPerso extends Route
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
     * Affiche le formulaire d’édition pré-rempli d’un personnage.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $id = $this->getParam($params, "id", false);
        $this->persoController->displayEditPerso($id);
    }

    /**
     * Enregistre les modifications d’un personnage et redirige vers l’accueil.
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
        try {
            $data = [
                "id"        => $this->getParam($params, "id", false),
                "name"      => $this->getParam($params, "name", false),
                "element"   => $this->getParam($params, "element", false),
                "unitclass" => $this->getParam($params, "unitclass", false),
                "rarity"    => (int)$this->getParam($params, "rarity", false),
                "origin"    => $this->getParam($params, "origin", true),
                "image"     => $this->getParam($params, "image", false),
            ];

            $this->persoController->editPersoAndIndex($data);

        } catch (\Exception $e) {
            $this->persoController->displayEditPerso(
                $params["id"] ?? "",
                $e->getMessage()
            );
        }
    }
}
