<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="sectionHomepage">

    <h1 id="bigTitle" class="animate-pop-in">
        <a href="<?php echo HOST; ?>home">Billet simple pour l'Alaska</a>
    </h1><br>
    
    <p id="introWelcome" class="animate-pop-in">Prêt pour un voyage inoubliable ?</p>

    <a href="<?= HOST; ?>listChapters" id="buttonWelcome" class="animate-pop-in">Embarquer pour l'Alaska</a>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('templateHomepage.php'); ?>