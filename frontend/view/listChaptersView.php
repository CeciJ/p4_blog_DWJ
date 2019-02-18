<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<br><p id="introWelcome">Plongez-vous de ce pas dans les aventures de ce livre !</p>

<div id="viewChapters">
    
    <?php
    foreach($chapters as $chapter) //while ($data = $chapters->fetch())
    {
    ?>
        <div class="extraitChap">
            <h3>
                <a href="<?php echo HOST; ?>chapter-<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()); ?></a>
                <!--<a href="index.php?action=chapter&amp;id=<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()); ?></a>-->
            </h3>
            <h4>Publié le <?= $chapter->creationDate(); ?><?php
                if($chapter->editDate() !== NULL){
                    ?>
                    - Modifié le <?= $chapter->editDate(); ?>
                <?php
                }
                ?>
            </h4>
            <div class="imgChapter"><img src="<?= HOST; ?>images/<?= $chapter->id(); ?>.jpg"></div>
            <p class="extractChapter">
                <?php
                $tab = explode(' ', $chapter->content(), (LIMIT+1));
                if(count($tab) > LIMIT){array_pop($tab); }
                echo nl2br(implode(' ', $tab)); ?><a href="<?php echo HOST; ?>chapter-<?= $chapter->id(); ?>" class="clickExcerpt">...cliquez ici pour lire la suite</a>
                <br />
            </p>
        </div>
    <?php
    }
    ?>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>