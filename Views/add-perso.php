<?php $this->layout('template', ['title' => 'Ajouter un personnage']) ?>

<div class="form-container">

    <h1>Ajouter un personnage</h1>

    <?php if (!empty($message)): ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=add-perso">

        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Image :</label>
            <input type="text" name="image" placeholder="URL de l'image">
        </div>

        <div class="form-group">
            <label>Élément :</label>
            <select name="element" required>
                <?php foreach ($elements as $e): ?>
                    <option value="<?= $e['id'] ?>">
                        <?= $this->e($e['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Classe :</label>
            <select name="unitclass" required>
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['id'] ?>">
                        <?= $this->e($c['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Origine :</label>
            <select name="origin">
                <option value="">Aucune</option>
                <?php foreach ($origins as $o): ?>
                    <option value="<?= $o['id'] ?>">
                        <?= $this->e($o['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Rareté :</label>
            <select name="rarity" required>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>">⭐ <?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <button class="btn-submit" type="submit">Créer</button>

    </form>

</div>
