<?php $title = 'Connexion à ma plateforme d\'administration'; ?>

<?php ob_start(); 

// Le mot de passe n'a pas été envoyé ou n'est pas bon

if (!isset($_POST['password']) OR $_POST['password'] != PASSWORD)
{
    // Afficher le formulaire de saisie du mot de passe
    ?> 
    <div class="connexionDiv">
        <p><strong>Bienvenue sur votre interface d'administration ! </strong></p>
        <p>Veuillez entrer votre pseudo et mot de passe pour vous connecter :</p>
        <form action="<?php echo HOST; ?>connectOK" method="post">
            <div class="container-fluid row justify-content-center">
                <div class="col-12 col-md-6"><label>Votre pseudo : </label> <input type="pseudo" name="pseudo" /></div>
                <div class="col-12 col-md-6"><label>Votre mot de passe : </label> <input type="password" name="password" /></div>
                <div class="col-12"><button type="submit">Valider</button>  </div>
            </div>
        </form>
    </div>
<?php
}

$content = ob_get_clean();

require('templateConnexion.php');
?>