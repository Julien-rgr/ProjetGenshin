<?php

namespace Controllers\Router\Route;

use Controllers\LogsController;
use Controllers\Router\Route;

class RouteLogs extends Route
{
    private LogsController $logsController;

    /**
     * @param LogsController $logsController
     */
    public function __construct(LogsController $logsController)
    {
        parent::__construct();
        $this->logsController = $logsController;
    }

    /**
     * Affiche la page des logs.
     *
     * @param array $params
     * @return void
     */
    public function get($params = []): void
    {
        $this->logsController->displayLogs();
    }

    /**
     * Affiche les logs même en cas de POST.
     *
     * @param array $params
     * @return void
     */
    public function post($params = []): void
    {
        $this->logsController->displayLogs();
    }
}
