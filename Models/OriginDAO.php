<?php

namespace Models;

class OriginDAO extends BasePDODAO
{
    /**
     * Récupère toutes les origines triées
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }

    /**
     * Récupère une origine par ID
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM origin WHERE id = :id";
        $res = $this->execRequest($sql, ["id" => $id])->fetch();
        return $res ?: null;
    }

    /**
     * Ajoute une nouvelle origine
     */
    public function create(string $name, string $url): void
    {
        $sql = "INSERT INTO origin (name, url_img) VALUES (:name, :url)";
        $this->execRequest($sql, [
            "name" => $name,
            "url"  => $url
        ]);
    }

    /**
     * Supprime une origine
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM origin WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    /**
     * Met à jour une origine
     */
    public function update(int $id, string $name, string $url): void
    {
        $sql = "
            UPDATE origin
            SET name = :name,
                url_img = :url
            WHERE id = :id
        ";

        $this->execRequest($sql, [
            "id"   => $id,
            "name" => $name,
            "url"  => $url
        ]);
    }
}
