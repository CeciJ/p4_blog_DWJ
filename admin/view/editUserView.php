<?php 
$title = 'Modifier un administrateur';
ob_start(); 
?>

<div class="sectionEditUser">

    <div class="formEditUser">
        <h2>Modifier les informations de l'administrateur : <?= $editUser->pseudo(); ?></h2><br/>

        <form action="<?= HOST; ?>editUser-<?= $editUser->id(); ?>" method="post">
            <div>
                <label>Nouveau pseudo : 
                    <input type="text" id="newPseudo" name="newPseudo" value="<?= $editUser->pseudo(); ?>">
                </label>
            </div>
            <div>
                <label>Nouveau mail : 
                    <input type="email" id="newMail" name="newMail" value="<?= $editUser->mail(); ?>">
                </label>
            </div>
            <br/>
            <button type="submit">Modifier</button>
        </form>
    </div>

</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 