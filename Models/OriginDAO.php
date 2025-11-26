<?php

namespace Models;

class OriginDAO extends BasePDODAO
{
    /**
     * Retourne toutes les origines triées par nom.
     *
     * @return array Liste des origines
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }

    /**
     * Retourne une origine à partir de son identifiant.
     *
     * @param int $id Identifiant de l’origine
     * @return array|null Origine trouvée ou null
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM origin WHERE id = :id";
        $res = $this->execRequest($sql, ["id" => $id])->fetch();
        return $res ?: null;
    }

    /**
     * Ajoute une nouvelle origine.
     *
     * @param string $name Nom de l’origine
     * @param string $url  URL de l’image associée
     * @return void
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
     * Supprime une origine.
     *
     * @param int $id Identifiant de l’origine
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM origin WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    /**
     * Met à jour une origine existante.
     *
     * @param int    $id   Identifiant de l’origine
     * @param string $name Nouveau nom
     * @param string $url  Nouvelle URL d’image
     * @return void
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
