<?php
namespace Models;
class PersonnageDAO extends BasePDODAO
{

    public function getAll(): Array {
        $sql = 'SELECT * FROM personnage';
        $personnages = $this->execRequest($sql)->fetchAll();
        $personnagesDTO = array();
        foreach ($personnages as $personnage) {
            $personnageDTO = new Personnage();
            $personnageDTO->hydrate($personnage);
            $personnagesDTO[] = $personnageDTO;}
        return $personnagesDTO;
    }

    public function getById(string $idPersonnage): ?Personnage{
        $sql = 'SELECT * FROM personnage WHERE id = :idPersonnage';
        $personnage = $this->execRequest($sql, ['idPersonnage' => $idPersonnage])->fetch();
        $personnageDTO = new Personnage();
        if ($personnage !== false) {
            $personnageDTO->hydrate($personnage);
        }
        return $personnageDTO;
    }

}