<?php
namespace Models;

class Personnage {
    private ?string $id;
    private string $name;
    private string $element;
    private string $unitclass;
    private int $rarity;
    private ?string $origin;
    private string $urlImg;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getElement(): string
    {
        return $this->element;
    }

    public function setElement(string $element): void
    {
        $this->element = $element;
    }

    public function getUnitclass(): string
    {
        return $this->unitclass;
    }

    public function setUnitclass(string $unitclass): void
    {
        $this->unitclass = $unitclass;
    }

    public function getRarity(): int
    {
        return $this->rarity;
    }

    public function setRarity(int $rarity): void
    {
        $this->rarity = $rarity;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): void
    {
        $this->origin = $origin;
    }

    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }

    // Hydratation

    public function hydrate(array $data){
        foreach ($data as $key => $value){
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'.ucfirst($key);
            while (($pos = mb_strpos($method, '_')) !== false){
                $method = mb_substr($method, 0, $pos) . ucfirst(mb_substr($method, $pos + 1));
            }

            // Si le setter correspondant existe
            if(method_exists($this, $method)){
                // On appelle le setter
                $this->$method($value);
            }
        }
    }
}
