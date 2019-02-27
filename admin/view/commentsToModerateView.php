<?php 
$title = 'Commentaires à modérer';
ob_start();
?>

    <div class="sectionModerComments">   

        <h1>Commentaires à modérer</h1><br/>
        
        <?php
        if($commentsToModerate)
        {
        ?>
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
                    foreach($commentsToModerate as $comment) //while ($comment = $comments->fetch())
                    {
                    ?>
                        <script>
                            function ConfirmDeleteComment(){
                                var r = confirm('Êtes-vous sûr de vouloir effacer ce commentaire ?');
                                if (r == true)
                                {
                                    document.getElementById('deleteCommentButton').href = '<?php echo HOST; ?>deleteComment-<?= $comment->id() ?>';
                                }
                                else
                                {
                                    return false;
                                }
                            };
                        </script>
                   
                        <tr>
                            <td><?= htmlspecialchars($comment->title())?></td>
                            <td><?= htmlspecialchars($comment->author()) ?></td>
                            <td><?= $comment->creationDate()?></td>
                            <td><?= htmlspecialchars($comment->content())?></td>
                            <td>
                                <a href="<?php echo HOST; ?>editComment-<?= $comment->id() ?>">Modifier</a>
                            </td>
                            <td>
                                <a id="deleteCommentButton" href="#" onClick="ConfirmDeleteComment()">Supprimer</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        <?php
        }
        else
        {
        ?>
            <p>Il n'y a pas de commentaires à modérer.</p>
        <?php
        }
        ?>
    </div>

<?php 
$content = ob_get_clean();
require('template.php'); 