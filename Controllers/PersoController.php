<?php

namespace Controllers;

class PersoController
{

    private \League\Plates\Engine $templates;

    private MainController $mainController;

    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;
        $this->mainController = new MainController($templates);
    }

    public function displayAddPerso()
    {

        echo $this->templates->render('add-perso');
    }

    public function displayDelPerso()
    {

        $this->mainController->index();
    }

    public function displayEditPerso()
    {

        echo $this->templates->render('add-perso');
    }

}
