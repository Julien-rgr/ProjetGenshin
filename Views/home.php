<?php
    $this->layout('template', ['title' => 'home']);
?>
<h1>Collection <?= $this->e($gameName) ?><h1>
        <?php var_dump($personnages)?>
        <?php var_dump($personnageId)?>
        <?php var_dump($personnageNotId)?>
