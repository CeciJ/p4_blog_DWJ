<?php $title = 'Ma plateforme d\'administration'; ?>

<?php ob_start(); 
    //print_r($_SESSION);
    ?>

    <div class="sectionAdmin">

    <h1>Bienvenue sur votre page d'administration !</h1>
        <br/>
        <?php
        if($commentsToModerate){
        ?>
            <p>Vous avez <?= $commentsToModerate; ?> 
                    <?php
                    if($commentsToModerate > 1) { ?> commentaires à modérer !</p>
                    <?php } else { ?> commentaire à modérer !</p>
                    <?php } ?></p>
        <?php
        } else {
        ?>
            <p>Vous n'avez pas de commentaires à modérer !</p>
        <?php
        }
        ?>

        <ul>Vos statistiques :
            <li>Vous avez déjà publié <?= $nbChapters; ?> 
                    <?php
                    if($nbChapters > 1) { ?> chapitres.
                    <?php } else { ?> chapitre.
                    <?php } ?></li>
            <li>Vous avez reçu <?= $nbComments; ?> 
                    <?php
                    if($nbComments > 1) { ?> commentaires.
                    <?php } else { ?> commentaire.
                    <?php } ?></li>
            <li>Vous avez modéré <?= $nbEditedComments; ?>
                    <?php
                    if($nbEditedComments > 1) { ?> commentaires.
                    <?php } else { ?> commentaire.
                    <?php } ?></li>
        </ul>
    </div>

<?php
$content = ob_get_clean();

require('template.php');
?>