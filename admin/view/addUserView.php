<?php 
$title = 'Ajouter un Administrateur';
ob_start(); 
?>

<div class="sectionAddUser">
    
    <h2>Ajouter un nouvel utilisateur</h2>

    <?php if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass'])) { ?>
        <div id="msgConfirmAddUserOK" class="msgConfirNewAndEdit alert alert-info"><?= $success ?></div>
    <?php 
    } 
    ?>
        <form action="<?= HOST; ?>newUser" method="post" class="formAddUser">
            <div class="form-group">
                <label for="pseudo">Pseudo : 
                    <input class="form-control" type="text" id="pseudo" name="pseudo"/>
                </label>
            </div>
            <div class="form-group">
                <label for="mail">Mail : 
                    <input class="form-control" type="email" id="mail" name="mail" />
                </label>
            </div>
            <div class="form-group">
                <label for="pass">Mot de passe :
                    <input class="form-control" type="password" id="pass" name="pass" />
                </label>
            </div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>  
        </form>
   
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 