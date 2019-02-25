<?php $title = 'Modifier un administrateur'; ?>

<?php ob_start(); ?>

    <div class="sectionEditUser">
        <div class="formEditUser">
            <h1>Modifier les informations de l'administrateur : <?php echo $editUser->pseudo(); ?></h1><br/>

            <form action="<?php echo HOST; ?>editUser-<?= $editUser->id(); ?>" method="post">
                <label>Nouveau pseudo : <input type="text" id="newPseudo" name="newPseudo" value="<?php echo $editUser->pseudo(); ?>"></label><br><br>
                <label>Nouveau mail : <input type="email" id="newMail" name="newMail" value="<?php echo $editUser->mail(); ?>"></label><br><br>
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean();

require('template.php'); 
?>