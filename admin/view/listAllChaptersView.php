<?php 
$title = 'Ma plateforme d\'administration';
ob_start(); 
?>

<h2 class="listChapTitle">Liste des chapitres du blog</h2>
    <div id="changeOrdenChaptersAdmin">
        <form id="changeOrdenChaptersForm" name="OrdenChapters">
            <select name="OrdenChapters" onChange="location = this.options[this.selectedIndex].value;">
                <option value="">Ordre pour voir les chapitres</option>
                <option value="<?php echo HOST; ?>listAllChapters-ASC">Du plus ancien au plus récent</option>
                <option value="<?php echo HOST; ?>listAllChapters-DESC">Du plus récent au plus ancien</option>
            </select>
        </form>
    </div>

    <div class="sectionListChapters">
        <br/><br/>
        <?php
        if($chapters){
            foreach($chapters as $chapter) //while ($data = $chapters->fetch())
            {
            ?>
                <div class="extraitChapAdmin">
                    <h3>
                        <a href="<?php echo HOST; ?>chapterAdmin-<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()) ?></a>
                    </h3>
                    <h4 class="dates">Publié le <?= $chapter->creationDate() ?><?php
                        if($chapter->editDate() !== NULL){
                            ?>
                            <br/><span class="editDates">Modifié le <?= $chapter->editDate() ?></span>
                        <?php
                        }
                        ?>
                    </h4>
                    <div class="imgChapterAdmin">
                        <img src="<?= HOST; ?>images/<?= $chapter->id() ?>.jpg" alt="image Alaska">
                    </div>
                    <p class="extractChapter">
                        <?php
                        $tab = explode(' ', $chapter->content(), (LIMIT+1));
                        if(count($tab) > LIMIT){array_pop($tab); }
                        echo (implode(' ', $tab)); 
                        ?>
                        <a href="<?php echo HOST; ?>chapterAdmin-<?= $chapter->id()  ?>" class="clickExcerpt">...</a><br />
                    </p>
                </div>
            <?php
            }
        }
        else
        {
            ?>
            <div id="noChapters">Vous n'avez pas encore publié de chapitres !</div>
            <?php
        }
            ?> 
    </div>

<?php
$content = ob_get_clean();
require('templateAdmin.php');