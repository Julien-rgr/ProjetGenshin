<?php
namespace Models;

class ElementDAO extends BasePDODAO
{
    /**
     * Retourne tous les éléments triés par nom.
     *
     * @return array Liste des éléments
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM element ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }

    /**
     * Retourne un élément selon son ID.
     *
     * @param int $id ID de l’élément
     * @return array|null Élément trouvé ou null
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM element WHERE id = :id";
        $res = $this->execRequest($sql, ["id" => $id])->fetch();
        return $res ?: null;
    }

    /**
     * Crée un nouvel élément.
     *
     * @param string $name Nom de l’élément
     * @param string $url  URL de l’image
     * @return void
     */
    public function create(string $name, string $url): void
    {
        $sql = "INSERT INTO element (name, url_img) VALUES (:name, :url)";
        $this->execRequest($sql, [
            "name" => $name,
            "url"  => $url
        ]);
    }

    /**
     * Supprime un élément.
     *
     * @param int $id ID de l’élément
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM element WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    /**
     * Met à jour un élément.
     *
     * @param int $id    ID de l’élément
     * @param string $name Nouveau nom
     * @param string $url  Nouvelle URL de l’image
     * @return void
     */
    public function update(int $id, string $name, string $url): void
    {
        $sql = "
            UPDATE element
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
