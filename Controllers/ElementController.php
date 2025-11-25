<?php

namespace Controllers;

use League\Plates\Engine;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Models\OriginDAO;

class ElementController
{
    private Engine $templates;
    private MainController $mainController;

    public function __construct(Engine $templates)
    {
        $this->templates = $templates;
        $this->mainController = new MainController($templates);
    }

    /**
     * Affiche le formulaire d'ajout d’élément / classe / origine
     */
    public function displayAddElement(?string $message = null): void
    {
        echo $this->templates->render('add-perso-element', [
            "message" => $message
        ]);
    }

    /**
     * Ajoute un élément, une classe ou une origine
     */
    public function addElement(array $data): void
    {
        // Vérification des champs
        if (empty($data["name"]) || empty($data["type"])) {
            $this->displayAddElement("Tous les champs ne sont pas remplis.");
            return;
        }

        $name  = $data["name"];
        $image = $data["image"] ?? "";
        $type  = $data["type"];

        // Sélection du DAO selon le type
        switch ($type) {
            case "element":
                $dao = new ElementDAO();
                break;
            case "unitclass":
                $dao = new UnitClassDAO();
                break;
            case "origin":
                $dao = new OriginDAO();
                break;
            default:
                $this->displayAddElement("Type invalide !");
                return;
        }

        // Création
        $dao->create($name, $image);

        // Retour page d'accueil avec message
        $this->mainController->index();
    }
}
