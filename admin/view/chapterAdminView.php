<?php $title = 'Chapitre : '.$chapter->title(); ?>

<?php ob_start(); ?>
    
    <div class="sectionViewChapter">

        <a href="<?php echo HOST; ?>listAllChapters" class="backListChapters">Retour à la liste des chapitres</a>
        <?php
        //print_r($_SESSION);
        ?>
        <br/><br/>
        <a href="<?php echo HOST; ?>editChapter-<?= $chapter->id() ?>" class="editChapter">Modifier le chapitre</a>  
        <a id="deleteChapterButton" href="<?php echo HOST; ?>delete-<?= $chapter->id() ?>" class="deleteChapter">Supprimer le chapitre</a><br><br>

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

        <br/>
        <div id="chapterViewAdmin" class="chapter">
            <h3>
                <?= htmlspecialchars($chapter->title()) ?>
            </h3>
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
        
        <div class="commentsListAdmin">
            <?php
            if($chapter->nbComments() > 0){
                ?><p>Il y a <?= $chapter->nbComments(); ?> 
                    <?php
                        if($chapter->nbComments() > 1) { ?> commentaires reçus pour ce chapitre : </p>
                        <?php } else { ?> commentaire reçu pour ce chapitre : </p>
                        <?php
                        }
                        ?>

                    <table id="table_comments_admin" class="display">
                        <thead>
                            <tr>
                                <th data-priority='1'>Titre</th>
                                <th data-priority='2'>Auteur</th>
                                <th data-priority='5'>Publié le</th>
                                <th data-priority='3'>Contenu</th>
                                <th data-priority='4'>Signalé?</th>
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
                                <td><?php 
                                    if($comment->reported()){echo 'Oui';} 
                                    elseif ($comment->editDate()){echo 'Vous avez déjà modéré le commentaire.';}
                                    else {echo 'Non';}?></td>
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
            <p>Il n'y a pas encore de commentaires, soyez le premier à donner votre avis !</p>
            <?php
            }
        ?>
        </div>
    </div>
        
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>