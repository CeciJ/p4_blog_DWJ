<?php $title = 'Administrateurs autorisés'; ?>

<?php ob_start(); ?>

    <div class="sectionViewUsers">

        <h1>Liste des administrateurs autorisés</h1>
        <br>

        <table id="table_list_users" class="display">
            <thead>
                <tr>
                    <th data-priority='1'>Pseudo</th>
                    <th data-priority='4'>Mail</th>
                    <th data-priority='2'>Éditer les informations</th>
                    <th data-priority='3'>Supprimer</th>
                </tr>
            </thead>
            <tbody>

            <?php

                foreach($users as $user) //while ($data = $chapters->fetch())
                {
                ?>
                    <tr>
                        <td><?= $user->pseudo() ?></td>
                        <td><?= $user->mail() ?></td>
                        <td><a href="<?php echo HOST; ?>editUser-<?= $user->id() ?>">Éditer</a></td>
                        <td>
                            <?php
                            if(count($users) > 1)
                            {
                            ?>    
                            <a href="<?php echo HOST; ?>deleteUser-<?= $user->id() ?>">Supprimer</a>
                            <?php
                            } else {
                                echo 'Il n\'y a qu\'un seul administrateur enregistré, il ne peut pas être supprimé';
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
            ?>

        </tbody>
    </table>

    </div> 

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>