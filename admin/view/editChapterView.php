<?php 
$title = 'Modifier le chapitre : '.$chapter->title();
ob_start(); 
?>    

<div class="sectionEditChapter">

    <h2>Modifier le chapitre</h2>

    <?php if (isset($editedChapter)) {
        ?>
        <div class="msgConfirNewAndEdit alert alert-info"><?=$editedChapter ?></div>
        <a href="<?= HOST; ?>listAllChapters" class="msgPublishOrEditNew col-sm-6 col-md-4">Modifier un autre chapitre</a>
    <?php
    }
    else {
    ?>
        <a href="<?= HOST; ?>chapterAdmin-<?= $chapter->id() ?>" class="editChapter">Retourner au chapitre</a>

        <form action="<?= HOST; ?>editChapter-<?= $chapter->id(); ?>" method="post">
            <div class="form-group">
                <label for="newTitle">Titre :
                    <input class="form-control" type="text" id="newTitle" name="newTitle" value="<?=$chapter->title();?>" required/>
                </label>
            </div>
            <div class="form-group">
                <label for="contentEditChapter">Contenu : </label>
                <textarea class="form-control" id="contentEditChapter" name="newContent" rows="20" cols="100" required><?=$chapter->content();?></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Modifier</button>    
        </form>
    <?php
    }
    ?>
    
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php');