<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Personnage;
use Models\PersonnageDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Models\OriginDAO;

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
     * Affichage du formulaire d’ajout
     */
    public function displayAddPerso(?string $message = null): void
    {
        $elements = (new ElementDAO())->getAll();
        $classes  = (new UnitClassDAO())->getAll();
        $origins  = (new OriginDAO())->getAll();

        echo $this->templates->render('add-perso', [
            "message"  => $message,
            "elements" => $elements,
            "classes"  => $classes,
            "origins"  => $origins
        ]);
    }

    /**
     * Création du personnage
     */
    public function addPerso(array $data): void
    {
        $perso = new Personnage();
        $perso->hydrate([
            "id"        => uniqid(),
            "name"      => $data["name"],
            "element"   => (int)$data["element"],
            "unitclass" => (int)$data["unitclass"],
            "rarity"    => (int)$data["rarity"],
            "origin"    => ($data["origin"] === "" ? null : (int)$data["origin"]),
            "urlImg"    => $data["image"]
        ]);

        $this->dao->createPersonnage($perso);

        // Redirection vers l'accueil
        $this->mainController->index("Personnage créé !");
    }

    /**
     * Suppression
     */
    public function deletePerso(string $id): void
    {
        $this->dao->deletePersonnage($id);
        $this->mainController->index("Personnage supprimé !");

    }

    /**
     * Affichage du formulaire d'édition
     */
    public function displayEditPerso(string $id, ?string $message = null): void
    {
        $perso = $this->dao->getById($id);

        $elements = (new ElementDAO())->getAll();
        $classes  = (new UnitClassDAO())->getAll();
        $origins  = (new OriginDAO())->getAll();

        echo $this->templates->render('edit-perso', [
            "perso"    => $perso,
            "message"  => $message,
            "elements" => $elements,
            "classes"  => $classes,
            "origins"  => $origins
        ]);
    }

    /**
     * Enregistrement de l’édition
     */
    public function editPersoAndIndex(array $data): void
    {
        $perso = new Personnage();
        $perso->hydrate([
            "id"        => $data["id"],
            "name"      => $data["name"],
            "element"   => (int)$data["element"],
            "unitclass" => (int)$data["unitclass"],
            "rarity"    => (int)$data["rarity"],
            "origin"    => ($data["origin"] === "" ? null : (int)$data["origin"]),
            "urlImg"    => $data["image"]
        ]);

        $this->dao->editPersonnage($perso);

        $this->mainController->index("Personnage modifié !");

    }

    /**
     * Affichage d’un détail
     */
    public function displayDetail(string $id): void
    {
        $perso = $this->dao->getById($id);

        echo $this->templates->render('detail-perso', [
            "perso" => $perso
        ]);
    }
}
