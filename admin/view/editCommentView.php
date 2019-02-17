<?php $title = 'Mon chapitre'; ?>

<?php ob_start(); ?>

    <div class="sectionEditComment">
        <div class="formEditComment">
            <p>Modérer le commentaire : <strong><?php echo $editComment->title(); ?></strong></p>

            <form action="index.php?action=editComment&amp;id=<?= $editComment->id(); ?>" method="post">
                <label>Titre : <input type="text" id="newTitle" name="newTitle" value="<?php echo $editComment->title(); ?>"></label><br>
                <label>Contenu : <textarea id="newContent" name="newContent" rows="4" cols="40"><?php echo $editComment->content(); ?></textarea></label><br>
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean();

require('template.php'); 
?>