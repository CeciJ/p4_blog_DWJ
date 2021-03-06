<?php $title = 'Billet simple pour l\'Alaska'; ?>
<?php ob_start(); ?>

<p id="introWelcomeFrontend">Plongez-vous dès maintenant dans les aventures de ce livre !</p>

<div id="changeOrdenChapters">
    <form id="changeOrdenChaptersForm" name="OrdenChapters">
        <select name="OrdenChapters" onChange="location = this.options[this.selectedIndex].value;">
            <option value="">Ordre pour voir les chapitres</option>
            <option value="<?= HOST; ?>listChapters-ASC">Du plus ancien au plus récent</option>
            <option value="<?= HOST; ?>listChapters-DESC">Du plus récent au plus ancien</option>
        </select>
    </form>
</div>

<div id="listChapters">

    <?php if($chapters){
        foreach($chapters as $chapter) 
        { ?>
            <div class="panelChapter">
                <h3>
                    <a href="<?= HOST; ?>chapter-<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()); ?></a>
                </h3>
                <h4>Publié le <?= $chapter->creationDate(); ?>
                    <?php if($chapter->editDate() !== NULL) { ?>
                        - Modifié le <?= $chapter->editDate(); ?>
                    <?php } ?>
                </h4>
                <div class="imgChapter">
                    <img src="<?= HOST; ?>images/<?= $chapter->id(); ?>" alt="image Alaska">
                </div>
                <?php
                    $textChapter = $chapter->content();
                    $textOK = strip_tags($textChapter);
                    $tab = explode(' ', $textOK, (LIMIT+1));
                    if(count($tab) > LIMIT) { array_pop($tab); }
                    $text = implode(' ', $tab);
                ?>
                <?= $text; ?>
                <a href="<?= HOST; ?>chapter-<?= $chapter->id(); ?>" class="clickExcerpt">...cliquez ici pour lire la suite</a>
            </div>
        <?php 
        }
    } else { ?>
        <div id="noChapters">Il n'y a pas encore de chapitres publiés !</div>
    <?php } ?>
</div>

<?php 
$content = ob_get_clean();
require('templateFront.php'); ?>