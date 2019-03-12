<?php 
$title = 'Commentaires à modérer';
ob_start();
?>

<div class="sectionModerComments">   

    <h2>Commentaires à modérer</h2><br/>
    
    <?php if (isset($msgEditCommentOk)) {
        if($msgEditCommentOk) { ?>
        <div id="msgEditCommentOk" class="alert alert-info" role="alert"><?= $msgEditCommentOk; ?></div>
    <?php } 
    }?>

    <?php if (isset($msgDelCommentOk)) {
        if($msgDelCommentOk) { ?>
        <div id="msgDelCommentOk" class="alert alert-info" role="alert"><?= $msgDelCommentOk; ?></div>
    <?php } 
    }?>

    <?php if(!empty($commentsToModerate))
    { ?>
        <p>Tous les commentaires à modérer : </p>

        <table id="table_comments_admin" class="display">
            <thead>
                <tr>
                    <th data-priority='1'>Titre</th>
                    <th data-priority='5'>Auteur</th>
                    <th data-priority='6'>Publié le</th>
                    <th data-priority='2'>Contenu</th>
                    <th data-priority='3'>Modifier</th>
                    <th data-priority='4'>Supprimer</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach($commentsToModerate as $comment) 
                {
          
                ?>

                    <tr>
                        <td><?= htmlspecialchars($comment->title())?></td>
                        <td><?= htmlspecialchars($comment->author()) ?></td>
                        <td><?= $comment->creationDate()?></td>
                        <td><?= htmlspecialchars($comment->content())?></td>
                        <td>
                            <a href="<?= HOST; ?>editComment-<?= $comment->id() ?>">Modifier</a>
                        </td>
                        <td>
                            <a id="deleteCommentButton<?=$comment->id()?>" href="<?= HOST; ?>deleteComment-<?= $comment->id() ?> " onClick="Supp(this.href); return(false);">Supprimer</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>

        </table>
    <?php
    } else { ?>
        <p class="alert alert-info">Il n'y a pas de commentaires à modérer.</p>
    <?php
    }
    ?>
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 