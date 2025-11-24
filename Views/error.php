<?php $this->layout('template', ['title' => 'Erreur']) ?>

<div class="form-container" style="text-align:center;">
    <h1 style="color:#ff6b6b;">❌ Une erreur est survenue</h1>

    <p><?= $this->e($message) ?></p>

    <a href="index.php" class="btn-submit" style="margin-top:2rem; display:inline-block; width:auto;">
        Retour à l'accueil
    </a>
</div>
