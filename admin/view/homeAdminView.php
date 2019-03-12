<?php 
$title = 'Ma plateforme d\'administration';
ob_start(); 
?>

<div class="sectionAdmin">

    <h2>Bienvenue sur votre page d'administration !</h2><br/>

    <p class="alert alert-info">
        <?php if($commentsToModerate){ ?>
            <strong>
                Vous avez <?= $commentsToModerate; ?> 
                <?php
                if($commentsToModerate > 1) { ?> commentaires <?php } 
                else { ?> commentaire <?php } 
                ?>
                à modérer !
            </strong>
        <?php
        } else {
        ?>
            Vous n'avez pas de commentaires à modérer !
        <?php
        }
        ?>
    </p>

    <h3>Vos statistiques :</h3>
    <ul id="statistiques">
        <li>Vous avez déjà publié <?= $nbChapters; ?> 
            <?php
            if($nbChapters > 1) { ?> chapitres.
            <?php } else { ?> chapitre.
            <?php } ?>
        </li>
        <li>Vous avez reçu <?= $nbComments; ?> 
            <?php
            if($nbComments > 1) { ?> commentaires.
            <?php } else { ?> commentaire.
            <?php } ?>
        </li>
        <li>Vous avez modéré <?= $nbEditedComments; ?>
            <?php
            if($nbEditedComments > 1) { ?> commentaires.
            <?php } else { ?> commentaire.
            <?php } ?>
        </li>
    </ul>
</div>

<?php
$content = ob_get_clean();
require('templateAdmin.php');