<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Personnage;
use Models\PersonnageDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Models\OriginDAO;
use Models\LogsDAO;

class PersoController
{
    private Engine $templates;
    private MainController $mainController;
    private PersonnageDAO $dao;
    private LogsDAO $logsDAO;

    /**
     * @param Engine $templates Moteur de templates Plates
     */
    public function __construct(Engine $templates)
    {
        $this->templates      = $templates;
        $this->mainController = new MainController($templates);
        $this->dao            = new PersonnageDAO();
        $this->logsDAO        = new LogsDAO();
    }

    /**
     * Affiche le formulaire d’ajout d’un personnage.
     *
     * @param string|null $message Message optionnel affiché au-dessus du formulaire
     * @return void
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
     * Crée un nouveau personnage.
     *
     * @param array $data Données envoyées par le formulaire
     * @return void
     */
    public function addPerso(array $data): void
    {
        $perso = new Personnage();
        $perso->hydrate([
            "id"        => uniqid(),
            "name"      => $data["name"],
            "element"   => (int) $data["element"],
            "unitclass" => (int) $data["unitclass"],
            "rarity"    => (int) $data["rarity"],
            "origin"    => ($data["origin"] === "" ? null : (int) $data["origin"]),
            "urlImg"    => $data["image"]
        ]);

        $this->dao->createPersonnage($perso);
        $this->logsDAO->addLog("Création du personnage : {$perso->getName()}", null);

        $this->mainController->index("Personnage créé !");
    }

    /**
     * Supprime un personnage par son ID.
     *
     * @param string $id Identifiant du personnage
     * @return void
     */
    public function deletePerso(string $id): void
    {
        $p = $this->dao->getById($id);

        $this->dao->deletePersonnage($id);

        if ($p) {
            $this->logsDAO->addLog("Suppression du personnage : {$p->getName()}", null);
        }

        $this->mainController->index("Personnage supprimé !");
    }

    /**
     * Affiche le formulaire d’édition d’un personnage.
     *
     * @param string      $id      Identifiant du personnage
     * @param string|null $message Message d’erreur éventuel
     * @return void
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
     * Enregistre les modifications effectuées sur un personnage.
     *
     * @param array $data Données modifiées provenant du formulaire d’édition
     * @return void
     */
    public function editPersoAndIndex(array $data): void
    {
        $perso = new Personnage();
        $perso->hydrate([
            "id"        => $data["id"],
            "name"      => $data["name"],
            "element"   => (int) $data["element"],
            "unitclass" => (int) $data["unitclass"],
            "rarity"    => (int) $data["rarity"],
            "origin"    => ($data["origin"] === "" ? null : (int) $data["origin"]),
            "urlImg"    => $data["image"]
        ]);

        $this->dao->editPersonnage($perso);
        $this->logsDAO->addLog("Modification du personnage : {$perso->getName()}", null);

        $this->mainController->index("Personnage modifié !");
    }

    /**
     * Affiche les détails d’un personnage.
     *
     * @param string $id Identifiant du personnage
     * @return void
     */
    public function displayDetail(string $id): void
    {
        $perso = $this->dao->getById($id);

        echo $this->templates->render('detail-perso', [
            "perso" => $perso
        ]);
    }
}
