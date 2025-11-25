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
        // GET = afficher le formulaire SANS PARAMÈTRE
        $this->persoController->displayAddPerso();
    }

    public function post($params = []): void
    {
        try {
            // Récupération sécurisée des données du formulaire
            $data = [
                "name"    => $this->getParam($params, "name", false),
                "image"   => $this->getParam($params, "image", false),
                "element" => $this->getParam($params, "element", false),
                "class"   => $this->getParam($params, "class", false),
                "origin"  => $this->getParam($params, "origin", false),
                "rarity"  => $this->getParam($params, "rarity", false),
            ];

            // Appel au contrôleur pour créer le personnage
            $this->persoController->addPerso($data);

        } catch (\Exception $e) {

            // Si une erreur survient, on renvoie vers le formulaire avec un message
            $this->persoController->displayAddPerso($e->getMessage());
        }
    }

}
