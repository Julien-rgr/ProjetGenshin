<?php $this->layout('template', ['title' => 'Ajouter un élément']) ?>

<div class="form-container">

    <h1>Ajouter un élément</h1>

    <?php if (!empty($message)): ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=add-perso-element">

        <!-- Nom -->
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" name="name" required>
        </div>

        <!-- Image -->
        <div class="form-group">
            <label>URL de l'image :</label>
            <input type="text" name="image" placeholder="URL de l'icône">
        </div>

        <!-- Type -->
        <div class="form-group">
            <label>Type :</label>
            <select name="type" required>
                <option value="element">Élément</option>
                <option value="unitclass">Classe</option>
                <option value="origin">Origine</option>
            </select>
        </div>

        <button class="btn-submit" type="submit">Créer</button>

    </form>

</div>
