<?php $title = 'Commentaires à modérer'; ?>

<?php ob_start();?>

    <div class="sectionModerComments">   

        <h1>Commentaires à modérer</h1>
        <br/>
        <?php

        //var_dump($commentsToModerate);
        if($commentsToModerate){
        ?>
            <p>Tous les commentaires à modérer : </p>

            <table id="table_comments_admin" class="display">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Publié le</th>
                        <th>Contenu</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                foreach($commentsToModerate as $comment) //while ($comment = $comments->fetch())
                {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($comment->title())?></td>
                        <td><?= htmlspecialchars($comment->author()) ?></td>
                        <td><?= $comment->creationDate()?></td>
                        <td><?= htmlspecialchars($comment->content())?></td>
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
?>