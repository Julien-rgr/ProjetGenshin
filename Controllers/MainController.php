<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController {

    private Engine $templates;

    public function __construct(Engine $templates) {
        $this->templates = $templates;
    }

    /**
     * Page des logs
     */
    public function displayLogs(): void
    {
        echo $this->templates->render('add-perso-element');
    }

    /**
     * Page Login
     */
    public function displayLogin(): void
    {
        echo $this->templates->render('login');
    }

    /**
     * Affiche simplement index (pas utilisée pour la home avec personnages)
     */
    public function displayIndex(): void
    {
        echo $this->templates->render('index');
    }

    /**
     * Page d’accueil — Liste tous les personnages + message optionnel
     */
    public function index(): void
    {
        $dao = new \Models\PersonnageDAO();
        $list = $dao->getAll();

        // Récupère le tri choisi
        $sort = $_GET['sort'] ?? null;

        if ($sort) {
            usort($list, function ($a, $b) use ($sort) {

                switch ($sort) {

                    case 'name':
                        return strcmp($a->getName(), $b->getName());

                    case 'name_desc':
                        return strcmp($b->getName(), $a->getName());

                    case 'rarity':
                        return $a->getRarity() <=> $b->getRarity();

                    case 'rarity_desc':
                        return $b->getRarity() <=> $a->getRarity();

                    case 'element':
                        return strcmp($a->getElement(), $b->getElement());

                    case 'class':
                        return strcmp($a->getUnitclass(), $b->getUnitclass());
                }

                return 0;
            });
        }

        echo $this->templates->render('home', [
            'listPersonnage' => $list,
            'message' => $_GET['message'] ?? null
        ]);
    }

}
