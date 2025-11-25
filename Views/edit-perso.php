<?php $this->layout('template', ['title' => 'Modifier un personnage']) ?>

<div class="form-container">

    <h1>Modifier un personnage</h1>

    <?php if (!empty($message)) : ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=edit-perso">

        <!-- ID caché -->
        <input type="hidden" name="id" value="<?= $this->e($perso->getId()) ?>">

        <!-- NOM -->
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="name" value="<?= $this->e($perso->getName()) ?>" required>
        </div>

        <!-- IMAGE -->
        <div class="form-group">
            <label>Image :</label>
            <input type="text" name="image" value="<?= $this->e($perso->getUrlImg()) ?>">
        </div>

        <!-- ÉLÉMENT -->
        <div class="form-group">
            <label>Élément :</label>
            <select name="element">
                <?php
                $elements = ["pyro", "hydro", "anemo", "cryo", "electro", "geo", "dendro"];
                foreach ($elements as $el) :
                    ?>
                    <option value="<?= $el ?>" <?= $perso->getElement() === $el ? 'selected' : '' ?>>
                        <?= ucfirst($el) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- CLASSE -->
        <div class="form-group">
            <label>Classe :</label>
            <select name="class">
                <?php
                $classes = ["épéiste", "archer", "catalyseur", "polemiste", "claymore"];
                foreach ($classes as $cl) :
                    ?>
                    <option value="<?= $cl ?>" <?= $perso->getUnitclass() === $cl ? 'selected' : '' ?>>
                        <?= ucfirst($cl) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- ORIGINE -->
        <div class="form-group">
            <label>Origine :</label>
            <select name="origin">
                <?php
                $origines = ["mondstadt","liyue","inazuma","sumeru","fontaine","natlan","snezhnaya", "Nod-Kraî"];
                foreach ($origines as $or) :
                    ?>
                    <option value="<?= $or ?>" <?= $perso->getOrigin() === $or ? 'selected' : '' ?>>
                        <?= ucfirst($or) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- RARETÉ -->
        <div class="form-group">
            <label>Rareté :</label>
            <select name="rarity">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= $perso->getRarity() == $i ? 'selected' : '' ?>>
                        ⭐ <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <button class="btn-submit" type="submit">Mettre à jour</button>

    </form>

</div>
