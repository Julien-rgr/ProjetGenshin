<?php $this->layout('template', ['title' => 'Ajouter un personnage']) ?>

<div class="form-container">

    <h1>Ajouter un personnage</h1>

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

        <button class="btn-submit">Créer</button>

    </form>

</div>
