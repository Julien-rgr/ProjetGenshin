<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController
{
    private Engine $templates;

    /**
     * @param Engine $templates Moteur de templates Plates
     */
    public function __construct(Engine $templates)
    {
        $this->templates = $templates;
    }

    /**
     * Affiche la page interne dédiée aux logs.
     *
     * @return void
     */
    public function displayLogs(): void
    {
        echo $this->templates->render('add-perso-element');
    }

    /**
     * Affiche la page de connexion.
     *
     * @return void
     */
    public function displayLogin(): void
    {
        echo $this->templates->render('login');
    }

    /**
     * Affiche la page d’accueil avec la liste des personnages.
     *
     * @param string|null $message Message d’information optionnel
     * @return void
     */
    public function index(?string $message = null): void
    {
        $dao = new PersonnageDAO();
        $list = $dao->getAll();

        $sort = $_GET['sort'] ?? null;

        if ($sort) {
            usort($list, function ($a, $b) use ($sort) {
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
