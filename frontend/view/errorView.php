<?php $title = 'Erreurs'; ?>
<?php ob_start(); ?>

<div class="sectionError front">

    <h2>Il semblerait qu'il y ait une erreur...</h2><br/>
    <p>Vous rencontrez l'erreur suivante : <?= $errorMessage ?></p>

    <?php if (($errorMessage === $msgErrorConnexion1) || ($errorMessage === $msgErrorConnexion2) || ($errorMessage === $msgErrorConnexion3))
    { ?>
        <br/>
        <a id="reconnexion" href="<?php HOST; ?>login">Réessayer de se connecter</a>
    <?php
    }
    elseif($_SESSION['id'])
    { ?>
        <br/>
        <a id="backHome" href="<?php HOST; ?>homeAdmin">Revenir à la page d'accueil de l'Administration</a>
    <?php
    }
    else
    { ?>
        <br/>
        <a id="backHome" href="<?php HOST; ?>listChapters">Revenir à la page d'accueil</a>
    <?php
    }
    ?>
</div>
   
<?php 
$content = ob_get_clean();
require('templateFront.php');