<?php 
$title = 'Ajouter un Administrateur';
ob_start(); 
?>

<div class="sectionAddUser">
    
    <h2>Ajouter un nouvel utilisateur</h2>

    <?php if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass'])) { ?>
        <div class="msgConfirNewAndEdit">Le nouvel administrateur a bien été ajouté !</div>
        <a href="<?= HOST; ?>newUser" class="msgPublishOrEditNew col-sm-6 col-md-4">Ajouter un autre administrateur</a>
    <?php 
    } else {
    ?>
        <form action="<?= HOST; ?>newUser" method="post" class="formAddUser">
            <div>
                <label for="pseudo">Pseudo : 
                    <input type="text" id="pseudo" name="pseudo"/>
                </label>
            </div>
            <div>
                <label for="mail">Mail : 
                    <input type="email" id="mail" name="mail" />
                </label>
            </div>
            <div>
                <label for="pass">Mot de passe :
                    <input type="password" id="pass" name="pass" />
                </label>
            </div>
            <div>
                <br/><button type="submit">Enregistrer</button>  
            </div>
        </form>
    <?php
    }
    ?>
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 