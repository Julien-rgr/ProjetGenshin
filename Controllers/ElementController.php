<?php

namespace Controllers;

class ElementController
{

    private \League\Plates\Engine $templates;

    private MainController $mainController;

    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;
        $this->mainController = new MainController($templates);
    }


    public function displayAddElement()
    {

        echo $this->templates->render('add-perso-element');
    }

}