<?php
namespace Controllers;


use Models\PersonnageDAO;

class MainController {

    private \League\Plates\Engine $templates;
    public function __construct(\League\Plates\Engine $templates) {
        $this->templates = $templates;
    }
    public function index() : void {
        $personnageDAO = new PersonnageDAO();
        $listePersonnage = $personnageDAO->getAll();
        $personnageId = $personnageDAO->getById("1");
        $personnageNotId = $personnageDAO->getById("2");
        echo $this->templates->render('home', ['gameName' => 'Genshin Impact', 'personnages' => $listePersonnage, 'personnageId' => $personnageId, 'personnageNotId' => $personnageNotId]);

    }
}