<?php 
$title = 'Ajouter un chapitre';
ob_start(); 
?> 

<div class="sectionAddChapter">   

    <h2>Ajouter un chapitre</h2>
    
    <?php if (isset($_POST['title']) && isset($_FILES['photo']) && isset($_POST['content'])) { ?>
        <div class="msgConfirNewAndEdit alert alert-info">Le nouveau chapitre a bien été ajouté !</div>
        <a href="<?= HOST; ?>addChapter" class="msgPublishOrEditNew col-sm-6 col-md-4">Publier un autre chapitre</a>
    <?php 
    } else {
    ?>
        <form action="<?= HOST; ?>addChapter" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titre du chapitre : 
                    <input class="form-control" type="text" id="title" name="title"/>
                </label>
            </div>
            <div class="form-group">
                <label for="photo">Photo du chapitre
                    <span id="photoWeigth">(Poids maximum autorisé : 2 Mo) :</span><br/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                    <input class="form-control-file" type="file" id="photo" name="photo"/>
                </label> 
            </div>
            <div>
                <label for="contentNewChapter">Contenu : </label>
                <textarea class="form-group" id="contentNewChapter" name="content" rows="15" cols="100"></textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Publier</button>    
            </div>
        </form>
    <?php
    }
    ?>
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 