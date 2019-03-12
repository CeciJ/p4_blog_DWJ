<?php 
$title = 'Modifier un administrateur';
ob_start(); 
?>

<div class="sectionEditUser">

    <div class="formEditUser">
        <h2>Modifier les informations de l'administrateur : <?= $editUser->pseudo(); ?></h2><br/>

        <form action="<?= HOST; ?>editUser-<?= $editUser->id(); ?>" method="post">
            <div class="form-group">
                <label>Nouveau pseudo : 
                    <input class="form-control" type="text" id="newPseudo" name="newPseudo" value="<?= $editUser->pseudo(); ?>">
                </label>
            </div>
            <div class="form-group">
                <label>Nouveau mail : 
                    <input class="form-control" type="email" id="newMail" name="newMail" value="<?= $editUser->mail(); ?>">
                </label>
            </div>
            <button class="btn btn-primary" type="submit">Modifier</button>
        </form>
    </div>

</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 