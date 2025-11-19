<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteLogs extends Route
{
    public function get($params = []): void
    {
        echo $this->templates->render('logs');
    }

    public function post($params = []): void
    {
    }
}
