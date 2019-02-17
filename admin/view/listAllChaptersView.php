<?php $title = 'Ma plateforme d\'administration'; ?>

<?php ob_start(); 
    //print_r($_SESSION);
    ?>
    <!--<br><a href="index.php?action=goToAddChapter">Ajouter un chapitre</a>-->
 
    <div class="sectionListChapters">

        <h1>Liste des chapitres du blog</h1>
        <br/>
        <?php
            foreach($chapters as $chapter) //while ($data = $chapters->fetch())
            {
            ?>
                <div class="chapterDiv">
                    <h3>
                        <a href="index.php?action=chapterAdmin&amp;id=<?= $chapter->id() ?>"><?= htmlspecialchars($chapter->title()) ?></a>
                        <em>le <?= $chapter->creationDate() ?></em>
                    </h3>
                    <img src="<?= HOST; ?>images/<?= $chapter->id() ?>.jpg" class="imgChapterAdmin">
                    <p class="extractChapterAdmin">
                        <?php
                        $tab = explode(' ', $chapter->content(), (LIMIT+1));
                        if(count($tab) > LIMIT){array_pop($tab); }
                        echo nl2br(implode(' ', $tab)); ?><a href="index.php?action=chapterAdmin&amp;id=<?= $chapter->id()  ?>">...</a>
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