<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteEditPerso extends Route
{
    private PersoController $persoController;

    public function __construct(PersoController $persoController)
    {
        parent::__construct(); // important !
        $this->persoController = $persoController;
    }

    /**
     * GET : afficher le formulaire pré-rempli
     */
    public function get($params = []): void
    {
        // Récupération de l'ID obligatoire
        $id = $this->getParam($params, "id", false);

        // Affiche le formulaire rempli avec les infos du perso
        $this->persoController->displayEditPerso($id);
    }

    /**
     * POST : enregistrer les modifications
     */
    public function post($params = []): void
    {
        try {
            // Récupération des données modifiées
            $data = [
                "id"        => $this->getParam($params, "id", false),
                "name"      => $this->getParam($params, "name", false),
                "element"   => $this->getParam($params, "element", false),
                "class"     => $this->getParam($params, "class", false),
                "rarity"    => (int)$this->getParam($params, "rarity", false),
                "origin"    => $this->getParam($params, "origin", false),
                "image"     => $this->getParam($params, "image", false),
            ];

            // Mise à jour
            $this->persoController->editPersoAndIndex($data);

        } catch (\Exception $e) {
            // En cas d'erreur → réaffiche le formulaire
            $this->persoController->displayEditPerso($params["id"], $e->getMessage());
        }
    }
}
