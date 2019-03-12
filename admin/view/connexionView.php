<?php 
$title = 'Connexion à ma plateforme d\'administration';
ob_start(); 

if (!isset($_POST['password']) OR $_POST['password'] != PASSWORD)
{
?> 
    <div class="connexionDiv">
        <p><strong>Bienvenue sur votre interface d'administration ! </strong></p>
        <p>Veuillez entrer votre pseudo et mot de passe pour vous connecter :</p>
        <form action="<?= HOST; ?>connectOK" method="post">
            <div class="form-group">
                <label>Votre pseudo :
                    <input class="form-control" type="text" name="pseudo" />
                </label> 
            </div>
            <div class="form-group">
                <label>Votre mot de passe : 
                    <input class="form-control" type="password" name="password" />
                </label> 
            </div>
            <button class="btn btn-primary" type="submit">Valider</button>  
        </form>
    </div>
<?php
}

$content = ob_get_clean();
require('templateConnexion.php');