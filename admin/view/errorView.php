<?php $title = 'Erreurs'; ?>

<?php ob_start(); ?>

<br/>
<p>Vous avez une erreur : <?= $errorMessage ?></p>
<br>

<?php

$content = ob_get_clean();

require('template.php');
?>