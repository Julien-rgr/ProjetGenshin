<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteAddPersoElement extends Route
{
    public function get($params = []): void
    {
        echo $this->templates->render('add-perso-element');
    }

    public function post($params = []): void
    {
    }
}
