<?php $title = 'Modifier le chapitre : '.$chapter->title(); ?>

<?php ob_start(); ?>    

    <div class="sectionEditChapter">

        <div class="row align-items-center justify-content-between">
            <div id="editTitle" class="col-12 col-sm-12 col-md-6"><h1>Modifier le chapitre</h1></div>
            <div class="col-12 col-sm-12 col-md-6 backChaptersButton"><a href="<?php echo HOST; ?>chapterAdmin-<?= $chapter->id() ?>" class="editChapter">Retourner au chapitre</a></div>
        </div>

        <form action="<?php echo HOST; ?>editChapter-<?= $chapter->id(); ?>" method="post">
            <div>
                <label for="newTitle">Titre :</label><br />
                <input type="text" id="newTitle" name="newTitle" value="<?=$chapter->title();?>" required/>
            </div>
            <div>
                <br>
                <label for="newContent">Contenu :</label><br />
                <textarea id="contentEditChapter" name="newContent" rows="50" cols="100" required><?=$chapter->content();?></textarea>
            </div>
            <div>
                <input type="submit" />    
            </div>
        </form>
    
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
