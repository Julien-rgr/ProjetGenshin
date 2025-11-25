<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteAddPerso extends Route
{
    private PersoController $persoController;

    public function __construct(PersoController $persoController)
    {
        parent::__construct();
        $this->persoController = $persoController;
    }

    public function get($params = []): void
    {
        // GET → afficher le formulaire d’ajout
        $this->persoController->displayAddPerso();
    }

    public function post($params = []): void
    {
        try {

            // 🔥 Correction totale → cohérent avec le formulaire et la BDD
            $data = [
                "name"      => $this->getParam($params, "name", false),
                "image"     => $this->getParam($params, "image", false),
                "element"   => $this->getParam($params, "element", false),
                "unitclass" => $this->getParam($params, "unitclass", false),   // ← CHANGÉ !
                "origin"    => $params["origin"] ?? "",   // nullable
                "rarity"    => $this->getParam($params, "rarity", false),
            ];

            // Création du personnage
            $this->persoController->addPerso($data);

        } catch (\Exception $e) {

            // Retour au formulaire en cas d’erreur
            $this->persoController->displayAddPerso($e->getMessage());
        }
    }
}
