<?php $title = 'Erreurs'; ?>

<?php ob_start(); ?>

<p>Vous avez une erreur ! : <?= $errorMessage ?></p>

<?php

$content = ob_get_clean();

require('template.php');
?>