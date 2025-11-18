<?php $this->layout('template', ['title' => 'Liste des Personnages']); ?>

<section class="container">
    <h1 class="page-title">Collection des Personnages</h1>

    <?php if (!empty($listPersonnage)) : ?>
        <div class="characters-grid">
            <?php foreach ($listPersonnage as $p) : ?>
                <div class="character-card" style="background-image: url('<?= $this->e($p->getUrlImg()) ?>');">
                    <div class="character-overlay">
                        <h2><?= $this->e($p->getName()) ?></h2>
                        <p><strong>Élément :</strong> <?= $this->e($p->getElement()) ?></p>
                        <p><strong>Classe :</strong> <?= $this->e($p->getUnitclass()) ?></p>
                        <p><strong>Origine :</strong> <?= $this->e($p->getOrigin() ?? 'Inconnue') ?></p>
                        <p><strong>Rareté :</strong> ⭐<?= $this->e($p->getRarity()) ?></p>

                        <div class="actions">
                            <a href="index.php?action=edit-perso&id=<?= $this->e($p->getId()) ?>" class="btn edit">✏️ Modifier</a>
                            <a href="index.php?action=del-perso&id=<?= $this->e($p->getId()) ?>" class="btn delete">🗑️ Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>Aucun personnage enregistré.</p>
    <?php endif; ?>
</section>