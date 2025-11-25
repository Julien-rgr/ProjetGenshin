<?php
namespace Models;

class Personnage {
    private ?string $id;
    private string $name;
    private int $element;      // ID de la table element
    private int $unitclass;    // ID de la table unitclass
    private int $rarity;
    private ?int $origin;      // ID de la table origin
    private string $urlImg;

    // --- NOUVEAUX CHAMPS (venant des JOIN SQL) ---
    private ?string $elementName = null;
    private ?string $unitclassName = null;
    private ?string $originName = null;

    // ------------------------
    // GETTERS / SETTERS de base
    // ------------------------

    public function getId(): ?string { return $this->id; }
    public function setId(?string $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getElement(): int { return $this->element; }
    public function setElement(int $element): void { $this->element = $element; }

    public function getUnitclass(): int { return $this->unitclass; }
    public function setUnitclass(int $unitclass): void { $this->unitclass = $unitclass; }

    public function getRarity(): int { return $this->rarity; }
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    public function getOrigin(): ?int { return $this->origin; }
    public function setOrigin(?int $origin): void { $this->origin = $origin; }

    public function getUrlImg(): string { return $this->urlImg; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    // ------------------------
    // GETTERS / SETTERS des NOMS liés
    // ------------------------

    public function getElementName(): ?string { return $this->elementName; }
    public function setElementName(?string $n): void { $this->elementName = $n; }

    public function getUnitclassName(): ?string { return $this->unitclassName; }
    public function setUnitclassName(?string $n): void { $this->unitclassName = $n; }

    public function getOriginName(): ?string { return $this->originName; }
    public function setOriginName(?string $n): void { $this->originName = $n; }

    // ------------------------
    // Hydratation automatique
    // ------------------------

    public function hydrate(array $data){
        foreach ($data as $key => $value){

            // generate setter name
            $method = 'set'.ucfirst($key);

            // handle snake_case
            while (($pos = mb_strpos($method, '_')) !== false){
                $method = mb_substr($method, 0, $pos)
                    . ucfirst(mb_substr($method, $pos + 1));
            }

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
}
