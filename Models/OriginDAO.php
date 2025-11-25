<?php

namespace Models;

class OriginDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin ORDER BY name ASC";
        return $this->execRequest($sql)->fetchAll();
    }


}