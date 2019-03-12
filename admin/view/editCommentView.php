<?php 
$title = 'Modifier les commentaires';
ob_start(); 
?>

<div class="sectionEditComment">
    <div class="formEditComment">
        <h2>Modérer le commentaire</h2>
        <strong><?= $editComment->title(); ?></strong> du <?php echo $editComment->creationDate(); ?><br><br>

        <form action="<?= HOST; ?>editComment-<?= $editComment->id(); ?>" method="post">
            <div class="form-group">
                <label>Titre : 
                    <input class="form-control" type="text" id="newTitle" name="newTitle" value="<?= $editComment->title(); ?>">
                </label>
            </div>
            <div class="form-group">
                <label>Contenu : </label>
                <textarea id="newContent" class="form-control" name="newContent" rows="4" cols="50"><?= $editComment->content(); ?></textarea>
            </div>
            <button class="btn-primary btn" type="submit">Modifier</button>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 