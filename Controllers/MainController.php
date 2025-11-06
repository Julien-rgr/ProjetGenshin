<?php
namespace Controllers;


use Models\PersonnageDAO;

class MainController {

    private \League\Plates\Engine $templates;
    public function __construct(\League\Plates\Engine $templates) {
        $this->templates = $templates;
    }
    public function index(): void
    {
        // DAO déjà codé en partie 2
        $dao = new \Models\PersonnageDAO();
        $listPersonnage = $dao->getAll();

        echo $this->templates->render('home', [
            'listPersonnage' => $listPersonnage
        ]);
    }
}