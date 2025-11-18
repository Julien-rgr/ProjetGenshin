<?php

namespace Controllers\Router\Route;

class Router
{
    private array $routeList;
    private array $ctrlList;
    private string $action_key;

    private function __construct($name_of_action_key='action') {
        $this->action_key = $name_of_action_key;

    }





}