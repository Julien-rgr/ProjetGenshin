<?php $this->layout('template', ['title' => 'Ajouter un élément']) ?>

<div class="form-container">

    <h1>Ajouter un élément</h1>

    <form method="post" action="index.php?action=add-perso-element">

        <div class="form-group">
            <label>Nom de l’élément :</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>URL de l'image :</label>
            <input type="text" name="image">
        </div>

        <div class="form-group">
            <label>Type de l’élément :</label>
            <select name="type">
                <option value="element">Élément</option>
                <option value="unitclass">Classe</option>
                <option value="origin">Origine</option>
            </select>
        </div>

        <button class="btn-submit" type="submit">Créer</button>

    </form>

</div>
