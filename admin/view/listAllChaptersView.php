<?php $title = 'Ma plateforme d\'administration'; ?>

<?php ob_start(); 
    //print_r($_SESSION);
    ?>
    <!--<br><a href="index.php?action=goToAddChapter">Ajouter un chapitre</a>-->
    <h1 class="listChapTitle">Liste des chapitres du blog</h1>
    <div id="changeOrdenChaptersAdmin">
        <form id="changeOrdenChaptersForm" name="OrdenChapters">
            <select name="OrdenChapters" onChange="location = this.options[this.selectedIndex].value;">
                <option value="">Ordre pour voir les chapitres</option>
                <option value="<?php echo HOST; ?>listAllChapters-ASC"">Du plus ancien au plus récent</option>
                <option value="<?php echo HOST; ?>listAllChapters-DESC">Du plus récent au plus ancien</option>
            </select>
        </form>
    </div>
    <div class="sectionListChapters">

        <br/><br/>
        <?php
        foreach($chapters as $chapter) //while ($data = $chapters->fetch())
        {
        ?>
            <div class="extraitChapAdmin">
                <h3>
                    <a href="<?php echo HOST; ?>chapterAdmin-<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()) ?></a>
                </h3>
                <h4>Publié le <?= $chapter->creationDate() ?><?php
                    if($chapter->editDate() !== NULL){
                        ?>
                        - Modifié le <?= $chapter->editDate() ?>
                    <?php
                    }
                    ?>
                </h4>
                <div class="imgChapterAdmin"><img src="<?= HOST; ?>images/<?= $chapter->id() ?>.jpg"></div>
                <p class="extractChapter">
                    <?php
                    $tab = explode(' ', $chapter->content(), (LIMIT+1));
                    if(count($tab) > LIMIT){array_pop($tab); }
                    echo (implode(' ', $tab)); ?><a href="<?php echo HOST; ?>chapterAdmin-<?= $chapter->id()  ?>" class="clickExcerpt">...</a>
                    <br />
                </p>
            </div>
        <?php
        }
        ?>
    </div>

<?php

$content = ob_get_clean();

require('template.php');
?>