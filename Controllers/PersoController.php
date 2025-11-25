<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Personnage;
use Models\PersonnageDAO;

class PersoController
{
    private Engine $templates;
    private MainController $mainController;
    private PersonnageDAO $dao;

    public function __construct(Engine $templates)
    {
        $this->templates = $templates;
        $this->mainController = new MainController($templates);
        $this->dao = new PersonnageDAO();
    }

    /**
     * Affiche le formulaire d’ajout (+ message éventuel)
     */
    public function displayAddPerso(?string $message = null): void
    {
        echo $this->templates->render('add-perso', [
            'message' => $message
        ]);
    }

    /**
     * Ajoute réellement un personnage dans la base (ou JSON)
     */
    public function addPerso(array $data): void
    {
        $id = uniqid();

        $perso = new \Models\Personnage();
        $perso->hydrate([
            "id"        => $id,
            "name"      => $data["name"],
            "element"   => $data["element"],
            "unitclass" => $data["class"],
            "rarity"    => (int)$data["rarity"],
            "origin"    => $data["origin"],
            "urlImg"    => $data["image"],
        ]);

        $dao = new \Models\PersonnageDAO();
        $dao->createPersonnage($perso);

        // Retour à l’accueil avec message
        $this->mainController->index("Personnage créé !");
    }

    public function deletePerso(string $id): void
    {
        $dao = new \Models\PersonnageDAO();
        $dao->deletePersonnage($id);

        $this->mainController->index("Personnage supprimé avec succès !");
    }

    public function displayEditPerso(string $id, string $message = null): void
    {
        $dao = new \Models\PersonnageDAO();
        $perso = $dao->getById($id);

        echo $this->templates->render('edit-perso', [
            "perso" => $perso,
            "message" => $message
        ]);
    }

    public function editPersoAndIndex(array $data): void
    {
        $dao = new \Models\PersonnageDAO();

        $perso = new \Models\Personnage();
        $perso->hydrate([
            "id"        => $data["id"],
            "name"      => $data["name"],
            "element"   => $data["element"],
            "unitclass" => $data["class"],
            "rarity"    => (int)$data["rarity"],
            "origin"    => $data["origin"],
            "urlImg"    => $data["image"],
        ]);

        $dao->editPersonnage($perso);

        $this->mainController->index("Personnage modifié !");
    }

    public function displayDetail(string $id): void
    {
        $dao = new \Models\PersonnageDAO();
        $perso = $dao->getById($id);

        echo $this->templates->render('detail-perso', [
            "perso" => $perso
        ]);
    }


}
