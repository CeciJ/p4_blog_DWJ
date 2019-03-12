<?php $title = 'Erreurs'; ?>
<?php ob_start(); ?>

<div class="sectionError front">

    <h2>Il semblerait qu'il y ait une erreur...</h2><br/>
    <p class="alert alert-danger">Vous rencontrez l'erreur suivante : <?= $errorMessage ?></p>

    <?php 
        if (isset($msgErrorConnexion1) || isset($msgErrorConnexion2) || isset($msgErrorConnexion3)) { ?>
            <br/>
            <a id="reconnexion" href="<?php HOST; ?>login">Réessayer de se connecter</a>
        <?php
        }
        elseif(isset($_SESSION['id']))
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