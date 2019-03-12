<?php 
$title = 'Ma plateforme d\'administration';
ob_start(); 
?>

<h2 class="listChapTitle">Liste des chapitres du blog</h2>

    <?php if(isset($deletedChapter)) { ?>
        <div id="msgConfirmDelChapterOK" class="alert alert-info" role="info"><?= $deletedChapter ?></div>
    <?php } ?>

    <div id="changeOrdenChaptersAdmin">
        <form id="changeOrdenChaptersForm" name="OrdenChapters">
            <select name="OrdenChapters" onChange="location = this.options[this.selectedIndex].value;">
                <option value="">Ordre pour voir les chapitres</option>
                <option value="<?= HOST; ?>listAllChapters-ASC">Du plus ancien au plus récent</option>
                <option value="<?= HOST; ?>listAllChapters-DESC">Du plus récent au plus ancien</option>
            </select>
        </form>
    </div>

    <div class="sectionListChapters">
        <br/><br/>
        <?php
        if(isset($chapters)){
            foreach($chapters as $chapter) //while ($data = $chapters->fetch())
            {
            ?>
                <div class="extraitChapAdmin">
                    <h3>
                        <a href="<?= HOST; ?>chapterAdmin-<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()) ?></a>
                    </h3>
                    <h4 class="dates">Publié le <?= $chapter->creationDate() ?>
                        <?php if($chapter->editDate() !== NULL){ ?>
                                <br/><span class="editDates">Modifié le <?= $chapter->editDate() ?></span>
                        <?php } ?>
                    </h4>
                    <div class="imgChapterAdmin">
                        <img src="<?= HOST; ?>images/<?= $chapter->id(); ?>" alt="image Alaska">
                    </div>
                    <?php
                        $textChapter = $chapter->content();
                        $textOK = strip_tags($textChapter);
                        $tab = explode(' ', $textOK, (LIMIT+1));
                        if(count($tab) > LIMIT)
                        {
                            array_pop($tab); 
                        }
                        $text = implode(' ', $tab);
                    ?>
                    <?= $text; ?>
                    <a href="<?= HOST; ?>chapter-<?= $chapter->id(); ?>" class="clickExcerpt">...cliquez ici pour lire la suite</a>
                </div>
            <?php
            }
        }
        else
        {
        ?>
            <div id="noChapters">Vous n'avez pas de chapitres publiés !</div>
        <?php
        }
        ?> 
    </div>

<?php
$content = ob_get_clean();
require('templateAdmin.php');