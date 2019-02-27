<?php 
$title = 'Modifier les commentaires';
ob_start(); 
?>

    <div class="sectionEditComment">
        <div class="formEditComment">
            <p>Modérer le commentaire : <strong><?php echo $editComment->title(); ?></strong> du <?php echo $editComment->creationDate(); ?></p>

            <form action="<?php echo HOST; ?>editComment-<?= $editComment->id(); ?>" method="post">
                <label>Titre : 
                    <input type="text" id="newTitle" name="newTitle" value="<?php echo $editComment->title(); ?>">
                </label>
                <label>Contenu : </label>
                <textarea id="newContent" name="newContent" rows="4" cols="50"><?php echo $editComment->content(); ?></textarea>
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>

<?php 
$content = ob_get_clean();
require('template.php'); 