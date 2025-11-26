<?php
namespace Models;

class LogsDAO extends BasePDODAO
{
    /**
     * Ajoute une entrée dans les logs.
     *
     * @param string      $action  Type d'action effectuée
     * @param string|null $details Informations supplémentaires
     * @return void
     */
    public function add(string $action, ?string $details = ""): void
    {
        $sql = "
            INSERT INTO logs (action_type, details, created_at)
            VALUES (:action, :details, NOW())
        ";

        $params = [
            "action"  => $action,
            "details" => $details ?? ""
        ];

        $this->execRequest($sql, $params);
    }

    /**
     * Alias de add() (nom exigé par le sujet).
     *
     * @param string      $action  Type d’action
     * @param string|null $details Détails additionnels
     * @return void
     */
    public function addLog(string $action, ?string $details = ""): void
    {
        $this->add($action, $details);
    }

    /**
     * Retourne toutes les entrées de logs par date décroissante.
     *
     * @return array Liste des logs
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM logs ORDER BY created_at DESC";
        return $this->execRequest($sql)->fetchAll();
    }
}
