<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteLogin extends Route
{
    public function get($params = []): void
    {
        echo $this->templates->render('login');
    }

    public function post($params = []): void
    {
    }
}
