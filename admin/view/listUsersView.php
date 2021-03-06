<?php 
$title = 'Administrateurs autorisés';
ob_start(); 
?>

<div class="sectionViewUsers">

    <h2>Liste des administrateurs autorisés</h2>

    <?php if (isset($msgEditUserOk)) { 
        if ($msgEditUserOk) { ?>
        <div class="alert alert-info" id="msgConfirmEditUserOk"><?= $msgEditUserOk; ?></div>
    <?php } 
    }?>

    <?php if (isset($success)) { ?>
        <div id="msgConfirmDelUserOK" class="msgConfirNewAndEdit alert alert-info"><?= $success ?></div>
    <?php
    }
    ?>

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
                foreach($users as $user)
                {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($user->pseudo()); ?></td>
                        <td><?= htmlspecialchars($user->mail()); ?></td>
                        <td><a href="<?= HOST; ?>editUser-<?= $user->id() ?>">Éditer</a></td>
                        <td>
                            <?php if(count($users) > 1) { ?>    
                                <a id="deleteUserButton<?=$user->id()?>" href="<?= HOST; ?>deleteUser-<?= $user->id() ?> " onClick="Supp(this.href); return(false);">Supprimer</a>
                            <?php } else {
                                echo 'Il n\'y a qu\'un seul administrateur enregistré, il ne peut pas être supprimé';
                            } ?>
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