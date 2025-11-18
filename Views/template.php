<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="Public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>
<body>
<header>
    <!-- Menu -->
    <nav class="topnav">
        <!-- Accueil: pas d'action -->
        <a class="navlink <?= ($currentAction ?? 'index') === 'index' ? 'active' : '' ?>" href="index.php">Accueil</a>

        <!-- Actions de la partie 3 §1.1 -->
        <a class="navlink <?= ($currentAction ?? '') === 'add-perso' ? 'active' : '' ?>" href="index.php?action=add-perso">Ajouter un perso</a>
        <a class="navlink <?= ($currentAction ?? '') === 'add-perso-element' ? 'active' : '' ?>" href="index.php?action=add-perso-element">Ajouter un élément</a>
        <a class="navlink <?= ($currentAction ?? '') === 'logs' ? 'active' : '' ?>" href="index.php?action=logs">Logs</a>
        <a class="navlink <?= ($currentAction ?? '') === 'login' ? 'active' : '' ?>" href="index.php?action=login">Se connecter</a>
    </nav>


</header>
<!-- #contenu -->
<main id="contenu">
    <?=$this->section('content') ?>
</main>
<footer>

</footer>
</body>
</html>
