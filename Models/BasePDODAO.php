<?php
namespace Models;
use Config\Config;

class BasePDODAO
{
    private \PDO $db;

    protected function execRequest(string $sql, array $params = null): \PDOStatement|false{
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    private function getDB() : \PDO {
        if (isset($this->db)){
            return $this->db;
        }
        $db = new \PDO(Config::get('dsn'), Config::get('user'), Config::get('pass'));
        $this->db = $db;
        return $db;

    }

}
