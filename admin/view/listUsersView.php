<?php 
$title = 'Administrateurs autorisés';
ob_start(); 
?>

    <div class="sectionViewUsers">

        <h2>Liste des administrateurs autorisés</h2><br>

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

                        <script>
                            function ConfirmDeleteUser(){
                                var r = confirm('Êtes-vous sûr de vouloir effacer cet administrateur ?');
                                if (r == true)
                                {
                                    document.getElementById('deleteUserButton').href = '<?php echo HOST; ?>deleteUser-<?= $user->id() ?>';
                                }
                                else
                                {
                                    return false;
                                }
                            };
                        </script>

                        <tr>
                            <td><?= htmlspecialchars($user->pseudo()); ?></td>
                            <td><?= htmlspecialchars($user->mail()); ?></td>
                            <td><a href="<?php echo HOST; ?>editUser-<?= $user->id() ?>">Éditer</a></td>
                            <td>
                                <?php
                                if(count($users) > 1)
                                {
                                ?>    
                                <a id="deleteUserButton" href="#" onClick="ConfirmDeleteUser()">Supprimer</a>
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

<?php 
$content = ob_get_clean();
require('templateAdmin.php');