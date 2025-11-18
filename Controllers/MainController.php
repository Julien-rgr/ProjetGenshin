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
        $action = $_GET['action'] ?? 'index';

        $listPersonnage = [];
        if ($action === 'index') {
            $dao = new \Models\PersonnageDAO();
            $listPersonnage = $dao->getAll();
        }

        switch ($action) {
            case 'add-perso':
                $view = 'add-perso';
                $vars = ['currentAction' => $action];
                break;

            case 'add-perso-element':
                $view = 'add-perso-element';
                $vars = ['currentAction' => $action];
                break;

            case 'logs':
                $view = 'logs';
                $vars = ['currentAction' => $action];
                break;

            case 'login':
                $view = 'login';
                $vars = ['currentAction' => $action];
                break;

            case 'index':
            default:
                $view = 'home';
                $vars = [
                    'listPersonnage' => $listPersonnage,
                    'currentAction' => $action
                ];
                break;
        }

        echo $this->templates->render($view, $vars);
    }

}