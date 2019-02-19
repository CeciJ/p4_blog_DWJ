<?php $title = 'Connexion à ma plateforme d\'administration'; ?>

<?php ob_start(); 

// Le mot de passe n'a pas été envoyé ou n'est pas bon

if (!isset($_POST['password']) OR $_POST['password'] != PASSWORD)
{
    // Afficher le formulaire de saisie du mot de passe
    ?> 
    <div class="connexionDiv">
        <p>Bienvenue sur votre interface d'administration ! <br/><br/>Veuillez entrer votre pseudo et mot de passe pour vous connecter :</p>
        <br/>
        <form action="<?php echo HOST; ?>connectOK" method="post">
            <p>
                <label>Votre pseudo : </label> <input type="pseudo" name="pseudo" />
                <label>Votre mot de passe : </label> <input type="password" name="password" />
                <input type="submit" value="Valider" />
            </p>
        </form>
    </div>
<?php
}

$content = ob_get_clean();

require('templateConnexion.php');
?>