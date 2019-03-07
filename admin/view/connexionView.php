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
            <div class="container-fluid row justify-content-center">
                <div class="col-12 col-md-6">
                    <label>Votre pseudo : </label> 
                        <input type="text" name="pseudo" />
                    </label> 
                </div>
                <div class="col-12 col-md-6">
                    <label>Votre mot de passe : 
                        <input type="password" name="password" />
                    </label> 
                </div>
                <div class="col-12">
                    <button type="submit">Valider</button>  
                </div>
            </div>
        </form>
    </div>
<?php
}

$content = ob_get_clean();
require('templateConnexion.php');