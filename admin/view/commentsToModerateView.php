<?php $title = 'Mon chapitre'; ?>

<?php ob_start();?>

    <div class="sectionModerComments">   

        <h1>Commentaires à modérer</h1>
        <br/>
        <?php

        //var_dump($commentsToModerate);
        if($commentsToModerate){
        ?>
            <p>Tous les commentaires à modérer : </p>

            <?php
                foreach($commentsToModerate as $comment) //while ($comment = $comments->fetch())
                {
                ?>
                    <div class="comment">
                        <p><strong><?= htmlspecialchars($comment->title())?></strong> par <strong><?= htmlspecialchars($comment->author()) ?></strong> le <?= $comment->creationDate() ?>
                        <br/><?= nl2br(htmlspecialchars($comment->content())) ?></p>
                        <p><a href="<?php echo HOST; ?>index.php?action=editComment&amp;id=<?= $comment->id()?>">Modifier</a> - <a href="<?php echo HOST; ?>index.php?action=deleteComment&amp;id=<?= $comment->id()?>">Supprimer</a></p>
                    </div>
                <?php
                }
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
?>