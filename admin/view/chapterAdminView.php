<?php $title = 'Chapitre : '.$chapter->title(); ?>

<?php ob_start(); ?>
    
    <div class="sectionViewChapter">

        <a href="<?php echo HOST; ?>listAllChapters" class="backListChapters">Retour à la liste des chapitres</a>
        <?php
        //print_r($_SESSION);
        ?>
        <br/>
        <br/>
        <a href="<?php echo HOST; ?>editChapter-<?= $chapter->id() ?>" class="editChapter">Modifier le chapitre</a>  
        <a href="<?php echo HOST; ?>delete-<?= $chapter->id() ?>" class="deleteChapter">Supprimer le chapitre</a><br><br>

        <div class="chapter">
            <h3><strong>
                <?= htmlspecialchars($chapter->title()) ?>
            </strong></h3>
            <em>Publié le <?= $chapter->creationDate() ?></em>

            <?php
            if($chapter->editDate() !== NULL){
                ?>
                <em> - Modifié le <?= $chapter->editDate() ?></em><br><br>
            <?php
            }
            ?>
            
            <p>
                <?= $chapter->content(); ?>
            </p>
        </div>

        <h3>Commentaires</h3>

        <?php
        if($chapter->nbComments() > 0){
            ?><p>Il y a <?= $chapter->nbComments(); ?> 
                <?php
                    if($chapter->nbComments() > 1) { ?> commentaires reçus pour ce chapitre : : </p>
                    <?php } else { ?> commentaire reçu pour ce chapitre : </p>
                    <?php
                    }
                    ?>
        <?php
            foreach($comments as $comment) //while ($comment = $comments->fetch())
            {
            ?>
                <div class="commentAdmin">
                    <p><strong><?= htmlspecialchars($comment->title())?></strong> par <strong><?= htmlspecialchars($comment->author()) ?></strong> le <?= $comment->creationDate() ?></p>
                    <p><?= nl2br(htmlspecialchars($comment->content())) ?></p>
                </div>
            <?php
            }
        } else {
            ?><p>Il n'y a pas encore de commentaires, soyez le premier à donner votre avis !</p>
        <?php
        }
        ?>

    </div>
        
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>