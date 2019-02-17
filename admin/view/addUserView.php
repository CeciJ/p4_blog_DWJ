<?php $title = 'Mon chapitre'; ?>

<?php ob_start(); ?>

    <div class="sectionAddUser">
        <?php

        if (isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass']))
        {
            echo 'Le nouvel administrateur a bien été ajouté !';
        }
        else
        {
            ?>
            <h1>Ajouter un nouvel utilisateur</h1>
            <br/>
            <form action="index.php?action=newUser" method="post">
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
                    <input type="submit" />    
                </div>
            </form>
        <?php
        }

        ?>
    <div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>