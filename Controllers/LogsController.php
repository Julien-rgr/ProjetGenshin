<?php

namespace Controllers;

use League\Plates\Engine;
use Models\LogsDAO;

class LogsController
{
    private Engine $templates;
    private LogsDAO $dao;

    /**
     * @param Engine $templates Moteur de templates Plates
     */
    public function __construct(Engine $templates)
    {
        $this->templates = $templates;
        $this->dao = new LogsDAO();
    }

    /**
     * Affiche la liste complète des logs.
     *
     * @return void
     */
    public function displayLogs(): void
    {
        $logs = $this->dao->getAll();

        echo $this->templates->render('logs', [
            "logs" => $logs
        ]);
    }

    /**
     * Ajoute une log dans la base.
     *
     * @param string $action Description de l’action enregistrée
     * @param int|null $idUser ID de l'utilisateur (optionnel)
     * @return void
     */
    public function addLog(string $action, ?int $idUser = null): void
    {
        $this->dao->addLog($action, $idUser);
    }
}
