<?php
namespace Models;

class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les personnages avec JOIN des tables liées
     */
    public function getAll(): array {
        $sql = "
            SELECT 
                p.*,
                e.name AS elementName,
                u.name AS unitclassName,
                o.name AS originName
            FROM personnage p
            JOIN element e ON p.element = e.id
            JOIN unitclass u ON p.unitclass = u.id
            LEFT JOIN origin o ON p.origin = o.id
        ";

        $rows = $this->execRequest($sql)->fetchAll();
        $list = [];

        foreach ($rows as $row) {
            $perso = new Personnage();
            $perso->hydrate($row);
            $list[] = $perso;
        }
        return $list;
    }

    /**
     * Récupère un personnage par son ID avec JOIN
     */
    public function getById(string $id): ?Personnage {
        $sql = "
            SELECT 
                p.*,
                e.name AS elementName,
                u.name AS unitclassName,
                o.name AS originName
            FROM personnage p
            JOIN element e ON p.element = e.id
            JOIN unitclass u ON p.unitclass = u.id
            LEFT JOIN origin o ON p.origin = o.id
            WHERE p.id = :id
        ";

        $row = $this->execRequest($sql, ["id" => $id])->fetch();

        if (!$row) {
            return null;
        }

        $perso = new Personnage();
        $perso->hydrate($row);
        return $perso;
    }

    /**
     * Création d’un personnage
     */
    public function createPersonnage(Personnage $perso): void
    {
        $sql = "
            INSERT INTO personnage 
            (id, name, element, unitclass, rarity, origin, url_img)
            VALUES (:id, :name, :element, :unitclass, :rarity, :origin, :urlImg)
        ";

        $params = [
            "id"        => $perso->getId(),
            "name"      => $perso->getName(),
            "element"   => $perso->getElement(),
            "unitclass" => $perso->getUnitclass(),
            "rarity"    => $perso->getRarity(),
            "origin"    => $perso->getOrigin(),
            "urlImg"    => $perso->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }

    /**
     * Supprime un personnage
     */
    public function deletePersonnage(string $id): void
    {
        $sql = "DELETE FROM personnage WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    /**
     * Met à jour un personnage
     */
    public function editPersonnage(Personnage $perso): void
    {
        $sql = "
            UPDATE personnage
            SET 
                name = :name,
                element = :element,
                unitclass = :unitclass,
                rarity = :rarity,
                origin = :origin,
                url_img = :urlImg
            WHERE id = :id
        ";

        $params = [
            "id"        => $perso->getId(),
            "name"      => $perso->getName(),
            "element"   => $perso->getElement(),
            "unitclass" => $perso->getUnitclass(),
            "rarity"    => $perso->getRarity(),
            "origin"    => $perso->getOrigin(),
            "urlImg"    => $perso->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }
}
