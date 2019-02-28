<?php $title = 'Erreurs'; ?>

<?php ob_start(); ?>

<div class="sectionError front">

    <h1>Mmmm... Il semblerait qu'il y ait une erreur...<h1><br/>
    <p>Vous rencontrez l'erreur suivante : <?= $errorMessage ?></p>

    <?php
    if ($errorMessage == $msgErrorCon2 OR $errorMessage == $msgErrorCon)
    {
        ?>
        <br/>
        <a id="reconnexion" href="<?php HOST; ?>login">Réessayer de se connecter</a>
        <?php
    }
    elseif($_SESSION['id'])
    {
        ?>
         <br/>
        <a id="backHome" href="<?php HOST; ?>homeAdmin">Revenir à la page d'accueil de l'Administration</a>
        <?php
    }
    else
    {
        ?>
         <br/>
        <a id="backHome" href="<?php HOST; ?>listChapters">Revenir à la page d'accueil</a>
        <?php
    }
    ?>
   

<?php $content = ob_get_clean(); ?>
<?php require('templateFront.php'); ?>