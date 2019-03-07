<?php $title = 'Chapitre : '.$chapter->title(); ?>
<?php ob_start(); ?>

    <div class="sectionViewChapterLector container-fluid">

        <?php if (isset($newComment)) {
            if ($newComment) { ?>
            <div id="msgConfirNewComment"><?= $newComment; ?></div>
        <?php } 
        }?>
        
        <div class="row buttonsBackAndChgeText justify-content-between">
            <div class="col-12 col-sm-6 col-md-6">
                <a href="<?= HOST; ?>listChapters" class="backListChaptersLector">Retour à la liste des chapitres</a>
            </div>
            <div class="col-12 col-sm-6 col-md-6" id="changeTextSize">
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

        <div class="row justify-content-center">
            <div id="chapterView" class="chapterView col-11 col-sm-10 col-md-8">
                <div class="nextPrevButtons">
                    <a href="<?= HOST; ?>prevChapter-<?= $chapter->id(); ?>" class="prev">Précédent</a>
                    <a href="<?= HOST; ?>nextChapter-<?= $chapter->id(); ?>" class="next">Suivant</a>
                </div>
                <div id="chapterText">
                    <h3>
                        <?= htmlspecialchars($chapter->title()) ?><br/>
                        <span>Publié le <?= $chapter->creationDate() ?></span><br/>
                        <?php
                        if($chapter->editDate()){ ?>
                            <span>Modifié le <?= $chapter->editDate() ?></span>
                        <?php } ?>
                    </h3>
                    <?= $chapter->content();?>
                </div>
                <div class="nextPrevButtons">
                    <a href="<?= HOST; ?>prevChapter-<?= $chapter->id(); ?>" class="prev">Précédent</a>
                    <a href="<?= HOST; ?>nextChapter-<?= $chapter->id(); ?>" class="next">Suivant</a>
                </div>
            </div>
        </div>
        
        <br/>

        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8" id="commentsForm" >
                <h2>Commentaires</h2>

                <p>Laissez votre commentaire ici !</p>

                <form action="<?= HOST; ?>addComment-<?= $chapter->id(); ?>" method="post" class="form">
                    <div>
                        <label for="title">Titre : 
                            <input type="text" id="title" name="title" required/>
                        </label>
                        <label for="author">Auteur : 
                            <input type="text" id="author" name="author" required/>
                        </label>
                    </div>
                    <div>
                        <label for="content">Commentaire : 
                            <textarea id="content" name="content" rows="6" cols="70" required></textarea>
                        </label>
                    </div>
                    <div id="sendComment">
                        <input type="submit"/>
                    </div>
                </form>

                <div id="commentsList">

                    <?php if($chapter->nbComments() > 0){ ?>
                        <p>Il y a déjà <?= $chapter->nbComments(); ?>     
                            <?php if($chapter->nbComments() > 1) { ?> 
                                commentaires reçus :
                            <?php } else { ?> 
                                commentaire reçu :
                            <?php } ?>
                        </p>

                        <table id="table_comments" class="display">
                            <thead>
                                <tr>
                                    <th data-priority='1'>Titre</th>
                                    <th data-priority='6'>Auteur</th>
                                    <th data-priority='3'>Publié le</th>
                                    <th data-priority='2'>Contenu</th>
                                    <th data-priority='4'>Signaler</th>
                                    <th data-priority='5'>Observation</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($comments as $comment) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($comment->title())?></td>
                                        <td><?= htmlspecialchars($comment->author()) ?></td>
                                        <td><?= $comment->creationDate()?></td>
                                        <td><?= htmlspecialchars($comment->content())?></td>
                                        <td><a href="<?= HOST; ?>reportComment-<?=$comment->id();?>-<?=$chapter->id();?>">Signaler</a></td>
                                        <td>
                                            <?php if($comment->reported() == 1) { ?>
                                                <span class="reportWaitComment">Commentaire en attente de modération</span>
                                            <?php } elseif ($comment->editDate()) { ?>
                                                <span class="reportedCommentOK">Commentaire modéré par l'administrateur</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                
                    <?php } else { ?>
                        <p>Il n'y a pas encore de commentaires, soyez le premier à donner votre avis !</p>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
  
<?php 
$content = ob_get_clean();
require('templateFront.php'); 