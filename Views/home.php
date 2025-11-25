<?php $this->layout('template', ['title' => 'Liste des Personnages']); ?>

<section class="container">

    <h1 class="page-title">Collection des Personnages</h1>

    <!-- Menu de tri -->
    <form method="get" class="sorting-bar">
        <input type="hidden" name="action" value="index">

        <select name="sort">
            <option value="">-- Trier par --</option>
            <option value="name">Nom (A → Z)</option>
            <option value="name_desc">Nom (Z → A)</option>
            <option value="rarity">Rareté (1 → 5)</option>
            <option value="rarity_desc">Rareté (5 → 1)</option>
            <option value="element">Élément (A → Z)</option>
            <option value="class">Classe (A → Z)</option>
        </select>

        <button class="sort-btn" type="submit">Trier</button>
    </form>



    <!-- 🔥 Message global (création, suppression, update) -->
    <?php if (!empty($message)) : ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

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
                            <a href="index.php?action=detail-perso&id=<?= $p->getId() ?>" class="btn">👁 Voir</a>

                            <a href="index.php?action=edit-perso&id=<?= $this->e($p->getId()) ?>"
                               class="btn edit">✏️ Modifier</a>

                            <a href="index.php?action=del-perso&id=<?= $this->e($p->getId()) ?>"
                               class="btn delete"
                               onclick="return confirm('Voulez-vous vraiment supprimer ce personnage ?');">
                                🗑️ Supprimer
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else : ?>

        <p>Aucun personnage enregistré.</p>

    <?php endif; ?>

</section>
