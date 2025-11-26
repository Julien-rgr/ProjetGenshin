<?php
namespace Models;

use Config\Config;
use PDO;
use PDOStatement;

class BasePDODAO
{
    private PDO $db;

    /**
     * Exécute une requête SQL préparée.
     *
     * @param string $sql   Requête SQL
     * @param array|null $params Paramètres à binder dans la requête
     * @return PDOStatement|false Résultat de la requête
     */
    protected function execRequest(string $sql, array $params = null): PDOStatement|false
    {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Retourne l'instance PDO active ou la crée si nécessaire.
     *
     * @return PDO Connexion PDO active
     */
    private function getDB(): PDO
    {
        if (isset($this->db)) {
            return $this->db;
        }

        $this->db = new PDO(
            Config::get('dsn'),
            Config::get('user'),
            Config::get('pass')
        );

        return $this->db;
    }
}
