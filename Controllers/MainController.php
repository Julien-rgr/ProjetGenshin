<?php
namespace Controllers;


use Models\PersonnageDAO;

class MainController {

    private \League\Plates\Engine $templates;
    public function __construct(\League\Plates\Engine $templates) {
        $this->templates = $templates;
    }

    public function displayLogs(){

        echo $this->templates->render('add-perso-element');
    }

    public function displayLogin(){

        echo $this->templates->render('login');
    }

    public function displayIndex(){

        echo $this->templates->render('index');
    }


    public function index(): void
    {



            $dao = new \Models\PersonnageDAO();
            $listPersonnage = $dao->getAll();

                $view = 'home';
                $vars = [
                    'listPersonnage' => $listPersonnage,

                ];



        echo $this->templates->render($view, $vars);
    }

}