<?php

namespace Controllers;

use League\Plates\Engine;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Models\OriginDAO;
use Models\LogsDAO;

class ElementController
{
    private Engine $templates;
    private MainController $mainController;
    private LogsDAO $logsDAO;

    /**
     * @param Engine $templates Moteur de templates Plates
     */
    public function __construct(Engine $templates)
    {
        $this->templates      = $templates;
        $this->mainController = new MainController($templates);
        $this->logsDAO        = new LogsDAO();
    }

    /**
     * Affiche le formulaire d’ajout d’un élément, d’une classe ou d’une origine.
     *
     * @param string|null $message Message optionnel
     * @return void
     */
    public function displayAddElement(?string $message = null): void
    {
        echo $this->templates->render('add-perso-element', [
            "message" => $message
        ]);
    }

    /**
     * Ajoute un élément, une classe ou une origine dans la base.
     *
     * @param array $data Données envoyées par le formulaire
     * @return void
     */
    public function addElement(array $data): void
    {
        if (empty($data["name"]) || empty($data["type"])) {
            $this->displayAddElement("Tous les champs ne sont pas remplis.");
            return;
        }

        $name = $data["name"];
        $url  = $data["image"] ?? "";
        $type = $data["type"];

        switch ($type) {
            case "element":
                $dao      = new ElementDAO();
                $typeName = "Élément";
                break;

            case "unitclass":
                $dao      = new UnitClassDAO();
                $typeName = "Classe";
                break;

            case "origin":
                $dao      = new OriginDAO();
                $typeName = "Origine";
                break;

            default:
                $this->displayAddElement("Type invalide.");
                return;
        }

        $dao->create($name, $url);
        $this->logsDAO->addLog("Ajout de $typeName : $name", null);

        $this->mainController->index("Ajout effectué !");
    }
}
