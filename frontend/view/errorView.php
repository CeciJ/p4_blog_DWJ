<?php $title = 'Erreurs'; ?>

<?php ob_start(); ?>
<br/>
<h1>Mmmm... Il semblerait qu'il y ait une erreur...<h1>
<br/>
<p>Vous rencontrez l'erreur suivante : <?= $errorMessage ?></p>
<br>
<?php

$content = ob_get_clean();

require('template.php');
?>