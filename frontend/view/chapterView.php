<?php $title = 'Mon chapitre'; ?>

<?php ob_start(); ?>
    <div class="sectionViewChapterLector">

        <br/><p><a href="index.php" class="backListChapters backListChaptersLector">Retour à la liste des chapitres</a></p>
        <button class="prev">Chapitre précédent</button><button class="next">Chapitre suivant</button>
        <div class="chapterView">
            <h3>
                <?= htmlspecialchars($chapter->title()) ?>
                le <?= $chapter->creationDate() ?>
            </h3>
            
            <p>
                <?= nl2br($chapter->content()) ?>
            </p>
        </div>
        <br>
        <hr>

        <div id="commentsForm">
            <h2>Commentaires</h2>

            <p>Laissez votre commentaire ici !</p>

            <form action="index.php?action=addComment&amp;id=<?= $chapter->id() ?>" method="post" class="form">
                <div>
                    <label for="title">Titre : </label>
                    <input type="text" id="title" name="title" />
                    <label for="author">Auteur : </label>
                    <input type="text" id="author" name="author" />
                </div>
                <div>
                    <label for="content">Commentaire : </label><br />
                    <textarea id="content" name="content" rows="6" cols="70"></textarea>
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
        </div>
        
        <div id="commentsList">

            <?php
            if($chapter->nbComments() > 0){
                ?><p>Il y a déjà <?= $chapter->nbComments(); ?>
                    <?php
                    if($chapter->nbComments() > 1) { ?> commentaires reçus : </p>
                    <?php } else { ?> commentaire reçu : </p>
                    <?php
                    }
        
                foreach($comments as $comment) //while ($comment = $comments->fetch())
                {
                ?>
                    <div class="comment">
                        <p><strong><?= htmlspecialchars($comment->title())?></strong> par <strong><?= htmlspecialchars($comment->author()) ?></strong> le <?= $comment->creationDate() ?>
                        <br/><?= nl2br(htmlspecialchars($comment->content())) ?></p>
                        <p class="reportedComment">
                            <a href="index.php?action=reportComment&amp;id=<?=$comment->id();?>&amp;idChapter=<?=$chapter->id();?>">Signaler ce commentaire</a>
                            <?php
                            if($comment->reported() == 1)
                            {
                            ?>
                                <br/><span class="reportWaitComment">Commentaire signalé en attente de modération par l'administrateur du site</span>
                            <?php
                            }
                            elseif($comment->editDate())
                            {
                            ?>
                                <br/><span class="reportedCommentOK">Ce commentaire a été modéré par l'administrateur du site</span>
                            <?php
                            }
                            ?>
                        </p>                    
                    </div>
                <?php
                }
            } else {
                ?><p>Il n'y a pas encore de commentaires, soyez le premier à donner votre avis !</p>
            <?php
            }
            ?>
        </div>
    </div>
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>