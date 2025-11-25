<?php
namespace Models;

class PersonnageDAO extends BasePDODAO
{
    public function getAll(): array {
        $sql = 'SELECT * FROM personnage';
        $personnages = $this->execRequest($sql)->fetchAll();
        $personnagesDTO = array();
        foreach ($personnages as $personnage) {
            $personnageDTO = new Personnage();
            $personnageDTO->hydrate($personnage);
            $personnagesDTO[] = $personnageDTO;
        }
        return $personnagesDTO;
    }

    public function getById(string $idPersonnage): ?Personnage {
        $sql = 'SELECT * FROM personnage WHERE id = :idPersonnage';
        $personnage = $this->execRequest($sql, ['idPersonnage' => $idPersonnage])->fetch();
        $personnageDTO = new Personnage();
        if ($personnage !== false) {
            $personnageDTO->hydrate($personnage);
        }
        return $personnageDTO;
    }

    public function createPersonnage(Personnage $perso): void
    {
        $sql = "INSERT INTO personnage (id, name, element, unitclass, rarity, origin, urlImg)
            VALUES (:id, :name, :element, :unitclass, :rarity, :origin, :urlImg)";

        $params = [
            'id'        => $perso->getId(),
            'name'      => $perso->getName(),
            'element'   => $perso->getElement(),
            'unitclass' => $perso->getUnitclass(),
            'rarity'    => $perso->getRarity(),
            'origin'    => $perso->getOrigin(),
            'urlImg'    => $perso->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }

    public function deletePersonnage(string $id): void
    {
        $sql = "DELETE FROM personnage WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);
    }

    public function editPersonnage(Personnage $perso): void
    {
        $sql = "UPDATE personnage
            SET name = :name,
                element = :element,
                unitclass = :unitclass,
                rarity = :rarity,
                origin = :origin,
                urlImg = :urlImg
            WHERE id = :id";

        $params = [
            'id'        => $perso->getId(),
            'name'      => $perso->getName(),
            'element'   => $perso->getElement(),
            'unitclass' => $perso->getUnitclass(),
            'rarity'    => $perso->getRarity(),
            'origin'    => $perso->getOrigin(),
            'urlImg'    => $perso->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
    }



}
