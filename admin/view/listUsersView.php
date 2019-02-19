<?php $title = 'Administrateurs autorisés'; ?>

<?php ob_start(); ?>

    <div class="sectionViewUsers">

        <h1>Liste des administrateurs autorisés</h1>
        <br>
        <?php
            foreach($users as $user) //while ($data = $chapters->fetch())
            {
            ?>
                <div class="user">
                    <h3><strong><?= $user->pseudo(); ?></strong> - <em><?= $user->mail(); ?></em></h3>
                </div>
            <?php
            }
        ?>
    </div> 

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>