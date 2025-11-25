<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController {

    private Engine $templates;

    public function __construct(Engine $templates) {
        $this->templates = $templates;
    }

    public function displayLogs(): void {
        echo $this->templates->render('add-perso-element');
    }

    public function displayLogin(): void {
        echo $this->templates->render('login');
    }

    /**
     * Page d’accueil — Liste tous les personnages + message optionnel
     */
    public function index(?string $message = null): void
    {
        $dao = new PersonnageDAO();
        $list = $dao->getAll();

        // Récupération du tri éventuel
        $sort = $_GET['sort'] ?? null;

        if ($sort) {
            usort($list, function($a, $b) use ($sort) {

                return match ($sort) {
                    'name'        => strcmp($a->getName(), $b->getName()),
                    'name_desc'   => strcmp($b->getName(), $a->getName()),
                    'rarity'      => $a->getRarity() <=> $b->getRarity(),
                    'rarity_desc' => $b->getRarity() <=> $a->getRarity(),
                    default       => 0,
                };
            });
        }

        echo $this->templates->render('home', [
            'listPersonnage' => $list,
            'message' => $message
        ]);
    }
}
