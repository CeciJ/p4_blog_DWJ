<?php 
$title = 'Erreurs';
ob_start(); 
?>

<div class="sectionError">

    <h1>Mmmm... Il semblerait qu'il y ait une erreur...<h1><br/>
    <p>Vous rencontrez l'erreur suivante : <?= $errorMessage ?></p>

<?php 
$content = ob_get_clean();
require('template.php');