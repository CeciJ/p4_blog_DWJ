<?php 
$title = 'Modifier les commentaires';
ob_start(); 
?>

<div class="sectionEditComment">
    <div class="formEditComment">
        <h2>Modérer le commentaire</h2><br>
        <strong><?= $editComment->title(); ?></strong> du <?php echo $editComment->creationDate(); ?>

        <form action="<?= HOST; ?>editComment-<?= $editComment->id(); ?>" method="post">
            <div>
                <label>Titre : 
                    <input type="text" id="newTitle" name="newTitle" value="<?= $editComment->title(); ?>">
                </label>
            </div>
            <div>
                <label>Contenu : </label>
                <textarea id="newContent" name="newContent" rows="4" cols="50"><?= $editComment->content(); ?></textarea>
            </div>
            <br/>
            <button type="submit">Modifier</button>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 