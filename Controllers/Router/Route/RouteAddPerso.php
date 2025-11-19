<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteAddPerso extends Route
{
    public function get($params = []): void
    {
        echo $this->templates->render('add-perso');
    }

    public function post($params = []): void
    {
    }
}
