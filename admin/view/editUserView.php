<?php 
$title = 'Modifier un administrateur';
ob_start(); 
?>

    <div class="sectionEditUser">
        <div class="formEditUser">
            <h1>Modifier les informations de l'administrateur : <?php echo $editUser->pseudo(); ?></h1><br/>

            <form action="<?php echo HOST; ?>editUser-<?= $editUser->id(); ?>" method="post">
                <div>
                    <label>Nouveau pseudo : 
                        <input type="text" id="newPseudo" name="newPseudo" value="<?php echo $editUser->pseudo(); ?>">
                    </label>
                </div>
                <div>
                    <label>Nouveau mail : 
                        <input type="email" id="newMail" name="newMail" value="<?php echo $editUser->mail(); ?>">
                    </label>
                </div>
                <br/>
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>

<?php 
$content = ob_get_clean();
require('template.php'); 