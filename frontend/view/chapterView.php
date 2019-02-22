<?php $title = 'Chapitre : '.$chapter->title(); ?>

<?php ob_start(); ?>
    <div class="sectionViewChapterLector">

        <br/>
        <div class="row buttonsBackAndChgeText">
            <div class="col-md-2"><a href="<?php echo HOST; ?>home" class="backListChaptersLector">Retour à la liste des chapitres</a></div>
            <div class="col-md-10">
                <form id="fontSizeForm" name="Font-Size">
                    <select name="Font-Size" onChange="ChangeFontSize()">
                        <option value="">Changer la taille du texte</option>
                        <option value="14">14px</option>
                        <option value="16">16px</option>
                        <option value="18">18px</option>
                        <option value="20">20px</option>
                        <option value="22">22px</option>
                    </select>
                </form>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2"><a href="<?php echo HOST; ?>prevChapter-<?= $chapter->id(); ?>" class="prev">Chapitre précédent</a></div>
            <div id="chapterView" class="chapterView col-md-8">
                <h3>
                    <?= htmlspecialchars($chapter->title()) ?>
                    le <?= $chapter->creationDate() ?>
                </h3>
                
                <p>
                    <?= nl2br($chapter->content()) ?>
                </p>
            </div>
            <div class="col-md-2"><a href="<?php echo HOST; ?>nextChapter-<?= $chapter->id(); ?>" class="next">Chapitre suivant</a></div>
        </div>
        
        <br>

        <div id="commentsForm">
            <h2>Commentaires</h2>

            <p>Laissez votre commentaire ici !</p>

            <form action="<?php echo HOST; ?>addComment-<?= $chapter->id(); ?>" method="post" class="form">
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
                    ?>

                    <table id="table_comments" class="display">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Publié le</th>
                            <th>Contenu</th>
                            <th>Signaler</th>
                            <th>Observation</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    foreach($comments as $comment) //while ($comment = $comments->fetch())
                    {
                    ?>

                        <tr>
                            <td><?= htmlspecialchars($comment->title())?></td>
                            <td><?= htmlspecialchars($comment->author()) ?></td>
                            <td><?= $comment->creationDate()?></td>
                            <td><?= htmlspecialchars($comment->content())?></td>
                            <td><a href="<?php echo HOST; ?>reportComment-<?=$comment->id();?>-<?=$chapter->id();?>">Signaler</a></td>
                            <td><?php
                            if($comment->reported() == 1)
                            {
                            ?>
                                <br/><span class="reportWaitComment">Commentaire en attente de modération</span>
                            <?php
                            }
                            elseif($comment->editDate())
                            {
                            ?>
                                <br/><span class="reportedCommentOK">Commentaire modéré par l'administrateur</span>
                            <?php
                            }
                            ?></td>
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
                ?><p>Il n'y a pas encore de commentaires, soyez le premier à donner votre avis !</p>
            <?php
            }
            ?>
        </div>
    </div>
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); 

/*
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
                            <a href="<?php echo HOST; ?>reportComment-<?=$comment->id();?>-<?=$chapter->id();?>">Signaler ce commentaire</a>
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

<?php require('template.php'); ?>*/