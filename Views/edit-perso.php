<?php $this->layout('template', ['title' => 'Modifier un personnage']) ?>

<div class="form-container">

    <h1>Modifier un personnage</h1>

    <?php if (!empty($message)) : ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=edit-perso">

        <input type="hidden" name="id" value="<?= $this->e($perso->getId()) ?>">

        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="name" value="<?= $this->e($perso->getName()) ?>" required>
        </div>

        <div class="form-group">
            <label>Image :</label>
            <input type="text" name="image" value="<?= $this->e($perso->getUrlImg()) ?>">
        </div>

        <div class="form-group">
            <label>Élément :</label>
            <select name="element">
                <?php foreach ($elements as $e): ?>
                    <option value="<?= $e['id'] ?>"
                            <?= ($perso->getElement() == $e['id']) ? 'selected' : '' ?>>
                        <?= $this->e($e['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Classe :</label>
            <select name="unitclass">
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['id'] ?>"
                            <?= ($perso->getUnitclass() == $c['id']) ? 'selected' : '' ?>>
                        <?= $this->e($c['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Origine :</label>
            <select name="origin">
                <option value="" <?= $perso->getOrigin() === null ? 'selected' : '' ?>>
                    Aucune
                </option>

                <?php foreach ($origins as $o): ?>
                    <option value="<?= $o['id'] ?>"
                            <?= ($perso->getOrigin() == $o['id']) ? 'selected' : '' ?>>
                        <?= $this->e($o['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Rareté :</label>
            <select name="rarity">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= $perso->getRarity() == $i ? 'selected' : '' ?>>
                        <?= str_repeat("⭐", $i) ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <button class="btn-submit" type="submit">Mettre à jour</button>

    </form>

</div>
