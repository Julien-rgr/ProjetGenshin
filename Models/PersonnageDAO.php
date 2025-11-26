<?php
namespace Models;

class PersonnageDAO extends BasePDODAO
{
    private LogsDAO $logsDAO;

    public function __construct()
    {
        $this->logsDAO = new LogsDAO();
    }

    /**
     * Récupère tous les personnages avec leurs relations (élément, classe, origine).
     *
     * @return array Liste des objets Personnage
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
     * Récupère un personnage via son ID.
     *
     * @param string $id Identifiant unique du personnage
     * @return Personnage|null Retourne l’objet ou null si introuvable
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

        if (!$row) return null;

        $perso = new Personnage();
        $perso->hydrate($row);
        return $perso;
    }

    /**
     * Crée un nouveau personnage dans la base de données.
     *
     * @param Personnage $perso Objet contenant les données à insérer
     * @return void
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

        $this->logsDAO->add("AJOUT PERSONNAGE", $perso->getName());
    }

    /**
     * Supprime un personnage via son identifiant.
     *
     * @param string $id ID du personnage
     * @return void
     */
    public function deletePersonnage(string $id): void
    {
        $perso = $this->getById($id);

        $sql = "DELETE FROM personnage WHERE id = :id";
        $this->execRequest($sql, ["id" => $id]);

        if ($perso) {
            $this->logsDAO->add("SUPPRESSION PERSONNAGE", $perso->getName());
        }
    }

    /**
     * Modifie les informations d’un personnage existant.
     * Génère un log contenant les modifications détectées.
     *
     * @param Personnage $perso Objet contenant les nouvelles valeurs
     * @return void
     */
    public function editPersonnage(Personnage $perso): void
    {
        $old = $this->getById($perso->getId());

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

        $changes = [];

        if ($old->getName() !== $perso->getName()) {
            $changes[] = "Nom : {$old->getName()} → {$perso->getName()}";
        }

        if ($old->getElementName() !== $perso->getElementName()) {
            $changes[] = "Élément : {$old->getElementName()} → {$perso->getElementName()}";
        }

        if ($old->getUnitclassName() !== $perso->getUnitclassName()) {
            $changes[] = "Classe : {$old->getUnitclassName()} → {$perso->getUnitclassName()}";
        }

        if ($old->getOriginName() !== $perso->getOriginName()) {
            $changes[] = "Origine : {$old->getOriginName()} → {$perso->getOriginName()}";
        }

        if ($old->getRarity() !== $perso->getRarity()) {
            $changes[] = "Rareté : {$old->getRarity()} → {$perso->getRarity()}";
        }

        if ($old->getUrlImg() !== $perso->getUrlImg()) {
            $changes[] = "Image : modifiée";
        }

        if (empty($changes)) {
            $this->logsDAO->add("MODIFICATION PERSONNAGE", "Aucun changement détecté pour {$perso->getName()}");
            return;
        }

        $details = "Modifications de {$perso->getName()} :\n" . implode("\n", $changes);

        $this->logsDAO->add("MODIFICATION PERSONNAGE", $details);
    }
}
