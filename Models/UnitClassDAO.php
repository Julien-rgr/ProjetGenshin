<?php
namespace Models;

class UnitClassDAO extends BasePDODAO
{
    /**
     * Retourne toutes les classes triées par nom
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }

    /**
     * Retourne une classe selon son ID
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM unitclass WHERE id = :id";
        $res = $this->execRequest($sql, ["id" => $id])->fetch();
        return $res ?: null;
    }

    /**
     * Crée une nouvelle classe
     */
    public function create(string $name, string $url): void
    {
        $sql = "INSERT INTO unitclass (name, url_img) VALUES (:name, :url)";
        $this->execRequest($sql, [
            "name" => $name,
            "url"  => $url
        ]);
    }

    /**
     * Supprime une classe
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM unitclass WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    /**
     * Met à jour une classe
     */
    public function update(int $id, string $name, string $url): void
    {
        $sql = "
            UPDATE unitclass
            SET name = :name, url_img = :url
            WHERE id = :id
        ";

        $this->execRequest($sql, [
            "id"   => $id,
            "name" => $name,
            "url"  => $url
        ]);
    }
}
