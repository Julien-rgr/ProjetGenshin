<?php $this->layout('template', ['title' => 'Ajouter un personnage']) ?>

<div class="form-container">

    <h1>Ajouter un personnage</h1>

    <?php if (!empty($message)): ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=add-perso">

        <!-- NOM -->
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="name" required>
        </div>

        <!-- IMAGE -->
        <div class="form-group">
            <label>Image :</label>
            <input type="text" name="image" placeholder="URL de l'image">
        </div>

        <!-- ÉLÉMENT -->
        <div class="form-group">
            <label>Élément :</label>
            <select name="element">
                <option value="pyro">Pyro</option>
                <option value="hydro">Hydro</option>
                <option value="anemo">Anemo</option>
                <option value="cryo">Cryo</option>
                <option value="electro">Electro</option>
                <option value="geo">Geo</option>
                <option value="dendro">Dendro</option>
            </select>
        </div>

        <!-- CLASSE -->
        <div class="form-group">
            <label>Classe :</label>
            <select name="class">
                <option value="épéiste">Épéiste</option>
                <option value="archer">Archer</option>
                <option value="catalyseur">Catalyseur</option>
                <option value="polemiste">Polemiste</option>
                <option value="claymore">Claymore</option>
            </select>
        </div>

        <!-- ORIGINE -->
        <div class="form-group">
            <label>Origine :</label>
            <select name="origin">
                <option value="mondstadt">Mondstadt</option>
                <option value="liyue">Liyue</option>
                <option value="inazuma">Inazuma</option>
                <option value="sumeru">Sumeru</option>
                <option value="fontaine">Fontaine</option>
                <option value="natlan">Natlan</option>
                <option value="snezhnaya">Snezhnaya</option>
                <option value="nod-krai">Nod-Kraî</option>
            </select>
        </div>

        <!-- RARETÉ -->
        <div class="form-group">
            <label>Rareté :</label>
            <select name="rarity">
                <option value="1">⭐ 1</option>
                <option value="2">⭐ 2</option>
                <option value="3">⭐ 3</option>
                <option value="4">⭐ 4</option>
                <option value="5">⭐ 5</option>
            </select>
        </div>

        <button class="btn-submit" type="submit">Créer</button>

    </form>

</div>
