<?php $this->layout('template', ['title' => 'Détail du personnage']) ?>

<div class="details-container">

    <div class="detail-card">

        <div class="detail-image"
             style="background-image: url('<?= $this->e($perso->getUrlImg()) ?>');">
        </div>

        <div class="detail-info">

            <h1><?= $this->e($perso->getName()) ?></h1>

            <p><strong>Élément :</strong> <?= $this->e($perso->getElementName()) ?></p>
            <p><strong>Classe :</strong> <?= $this->e($perso->getUnitclassName()) ?></p>
            <p><strong>Origine :</strong>
                <?= $this->e($perso->getOriginName() ?? "Inconnue") ?>
            </p>

            <p><strong>Rareté :</strong>
                <?= str_repeat("⭐", $perso->getRarity()) ?>
            </p>

            <div class="detail-actions">
                <a class="btn edit" href="index.php?action=edit-perso&id=<?= $perso->getId() ?>">✏ Modifier</a>

                <a class="btn delete"
                   href="index.php?action=del-perso&id=<?= $perso->getId() ?>"
                   onclick="return confirm('Supprimer ce personnage ?');">
                    🗑 Supprimer
                </a>

                <a class="btn" href="index.php">⬅ Retour</a>
            </div>

        </div>
    </div>

</div>
