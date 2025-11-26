<?php
namespace Models;

class UnitClassDAO extends BasePDODAO
{
    /**
     * Récupère toutes les classes d’armes, triées par nom.
     *
     * @return array Liste des enregistrements sous forme de tableaux associatifs
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }

    /**
     * Récupère une classe d'arme selon son identifiant.
     *
     * @param int $id Identifiant de la classe
     * @return array|null Retourne un tableau associatif ou null si introuvable
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM unitclass WHERE id = :id";
        $res = $this->execRequest($sql, ["id" => $id])->fetch();
        return $res ?: null;
    }

    /**
     * Crée une nouvelle classe d'arme.
     *
     * @param string $name Nom de la classe
     * @param string $url URL de l'image associée
     * @return void
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
     * Supprime une classe d'arme via son identifiant.
     *
     * @param int $id ID de la classe
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM unitclass WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    /**
     * Met à jour une classe d'arme.
     *
     * @param int $id Identifiant de la classe
     * @param string $name Nouveau nom
     * @param string $url Nouvelle URL d’image
     * @return void
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
