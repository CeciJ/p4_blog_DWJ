<?php 
$title = 'Ajouter un Administrateur';
ob_start(); 
?>

    <div class="sectionAddUser">
        
        <?php
        if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass']))
        {
        ?>
            <p><?= 'Le nouvel administrateur a bien été ajouté !'; ?></p>
        <?php 
        }
        else
        {
            ?>
            <h1>Ajouter un nouvel utilisateur</h1><br/>

            <form action="<?php echo HOST; ?>newUser" method="post" class="formAddUser">
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
                    <label for="pass">Mot de passe : </label>
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
    
    <div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 