<?php
namespace Models;

class UnitClassDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM unitclass WHERE id = :id";
        $res = $this->execRequest($sql, ["id" => $id])->fetch();
        return $res ?: null;
    }
}
