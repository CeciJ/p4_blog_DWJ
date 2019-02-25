<?php $title = 'Ajouter un Administrateur'; ?>

<?php ob_start(); ?>

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
            <h1>Ajouter un nouvel utilisateur</h1>
            <br/>
            <form action="<?php echo HOST; ?>newUser" method="post" class="formAddUser">
                <div>
                    <label for="pseudo">Pseudo : </label><br />
                    <input type="text" id="pseudo" name="pseudo"/>
                </div>
                <div>
                    <label for="mail">Mail : </label><br />
                    <input type="email" id="mail" name="mail" />
                </div>
                <div>
                    <label for="pass">Mot de passe : </label><br />
                    <input type="password" id="pass" name="pass" /><br/>
                </div>
                <br/>
                <div>
                    <button type="submit">Enregistrer</button>  
                </div>
            </form>
        <?php
        }

        ?>
    <div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>