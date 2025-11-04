<?php
namespace Controllers;


class MainController {

    private \League\Plates\Engine $templates;
    public function __construct(\League\Plates\Engine $templates) {
        $this->templates = $templates;
    }
    public function index() : void {
        echo $this->templates->render('home', ['gameName' => 'Genshin Impact']);
    }
}