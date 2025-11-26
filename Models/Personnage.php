<?php
namespace Models;

class Personnage
{
    private ?string $id;
    private string $name;
    private int $element;
    private int $unitclass;
    private int $rarity;
    private ?int $origin;
    private string $urlImg;

    private ?string $elementName = null;
    private ?string $unitclassName = null;
    private ?string $originName = null;

    /**
     * Retourne l'identifiant du personnage.
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Définit l'identifiant du personnage.
     *
     * @param string|null $id
     * @return void
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * Retourne le nom du personnage.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Définit le nom du personnage.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Retourne l'identifiant de l'élément.
     *
     * @return int
     */
    public function getElement(): int
    {
        return $this->element;
    }

    /**
     * Définit l'identifiant de l'élément.
     *
     * @param int $element
     * @return void
     */
    public function setElement(int $element): void
    {
        $this->element = $element;
    }

    /**
     * Retourne l'identifiant de la classe.
     *
     * @return int
     */
    public function getUnitclass(): int
    {
        return $this->unitclass;
    }

    /**
     * Définit l'identifiant de la classe.
     *
     * @param int $unitclass
     * @return void
     */
    public function setUnitclass(int $unitclass): void
    {
        $this->unitclass = $unitclass;
    }

    /**
     * Retourne la rareté du personnage.
     *
     * @return int
     */
    public function getRarity(): int
    {
        return $this->rarity;
    }

    /**
     * Définit la rareté du personnage.
     *
     * @param int $rarity
     * @return void
     */
    public function setRarity(int $rarity): void
    {
        $this->rarity = $rarity;
    }

    /**
     * Retourne l'identifiant de l'origine.
     *
     * @return int|null
     */
    public function getOrigin(): ?int
    {
        return $this->origin;
    }

    /**
     * Définit l'origine du personnage.
     *
     * @param int|null $origin
     * @return void
     */
    public function setOrigin(?int $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * Retourne l'URL de l'image.
     *
     * @return string
     */
    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    /**
     * Définit l'URL de l'image.
     *
     * @param string $urlImg
     * @return void
     */
    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }

    /**
     * Retourne le nom de l’élément lié.
     *
     * @return string|null
     */
    public function getElementName(): ?string
    {
        return $this->elementName;
    }

    /**
     * Définit le nom de l’élément.
     *
     * @param string|null $name
     * @return void
     */
    public function setElementName(?string $name): void
    {
        $this->elementName = $name;
    }

    /**
     * Retourne le nom de la classe liée.
     *
     * @return string|null
     */
    public function getUnitclassName(): ?string
    {
        return $this->unitclassName;
    }

    /**
     * Définit le nom de la classe.
     *
     * @param string|null $name
     * @return void
     */
    public function setUnitclassName(?string $name): void
    {
        $this->unitclassName = $name;
    }

    /**
     * Retourne le nom de l’origine liée.
     *
     * @return string|null
     */
    public function getOriginName(): ?string
    {
        return $this->originName;
    }

    /**
     * Définit le nom de l’origine.
     *
     * @param string|null $name
     * @return void
     */
    public function setOriginName(?string $name): void
    {
        $this->originName = $name;
    }

    /**
     * Hydrate automatiquement l'objet avec un tableau associatif.
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            while (($pos = mb_strpos($method, '_')) !== false) {
                $method = mb_substr($method, 0, $pos)
                    . ucfirst(mb_substr($method, $pos + 1));
            }

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
