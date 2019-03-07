<?php 
$title = 'Modifier le chapitre : '.$chapter->title();
ob_start(); 
?>    

<div class="sectionEditChapter">

    <h2>Modifier le chapitre</h2>

    <?php if (isset($_POST['newTitle']) && isset($_POST['newContent']))
    {
    ?>
        <div class="msgConfirNewAndEdit">Le chapitre a bien été modifié !</div>
        <a href="<?= HOST; ?>listAllChapters" class="msgPublishOrEditNew col-sm-6 col-md-4">Modifier un autre chapitre</a>
    <?php 
    } else {
    ?>
        <a href="<?= HOST; ?>chapterAdmin-<?= $chapter->id() ?>" class="editChapter">Retourner au chapitre</a>

        <form action="<?= HOST; ?>editChapter-<?= $chapter->id(); ?>" method="post">
            <div>
                <label for="newTitle">Titre :
                    <input type="text" id="newTitle" name="newTitle" value="<?=$chapter->title();?>" required/>
                </label>
            </div>
            <div>
                <label for="contentEditChapter">Contenu : </label>
                <textarea id="contentEditChapter" name="newContent" rows="20" cols="100" required><?=$chapter->content();?></textarea>
            </div>
            <div>
                <button type="submit">Modifier</button>    
            </div>
        </form>
    <?php
    }
    ?>
    
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php');
