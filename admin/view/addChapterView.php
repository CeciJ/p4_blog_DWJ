<?php $title = 'Ajouter un chapitre'; ?>

<?php ob_start(); ?>   
    <div class="sectionAddChapter">   
        <h1>Ajouter un chapitre</h1>
        <br/>
        <form action="<?php echo HOST; ?>addChapter" method="post" enctype="multipart/form-data">
            <div>
                <label for="title">Titre du chapitre : </label><br />
                <input type="text" id="title" name="title"/>
            </div>
            <div>
                <label for="photo">Photo du chapitre : </label><br />
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                <input type="file" id="photo" name="photo"/>
            </div>
            <div>
                <label for="content">Contenu : </label><br />
                <textarea id="contentNewChapter" name="content" rows="15" cols="100"></textarea>
            </div>
            <div>
                <input type="submit" />    
            </div>
        </form>

    </div>
    

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
