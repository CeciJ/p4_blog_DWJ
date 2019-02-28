<?php 
$title = 'Erreurs';
ob_start(); 
?>

<div class="sectionError admin">

    <h1>Mmmm... Il semblerait qu'il y ait une erreur...<h1><br/>
    <p>Vous rencontrez l'erreur suivante : <?= $errorMessage ?></p>

    <?php
    if ($errorMessage == "Votre identifiant ou mot de passe est erroné !" OR $errorMessage == "Tous les champs pour vous connecter ne sont pas remplis !")
    {
        ?>
        <br/>
        <a id="reconnexion" href="<?php HOST; ?>login">Réessayer de se connecter</a>
        <?php
    }

$content = ob_get_clean();
require('templateConnexion.php');