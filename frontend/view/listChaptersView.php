<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<br><p id="introWelcome">Plongez-vous de ce pas dans les aventures de ce livre !</p>

<div id="vueChapitres">
    
    <?php
    foreach($chapters as $chapter) //while ($data = $chapters->fetch())
    {
    ?>
        <div id="extraitChap">
            <h3>
                <a href="index.php?action=chapter&amp;id=<?= $chapter->id() ?>"><?= htmlspecialchars($chapter->title()) ?></a>
            </h3>
            <h4>Publié le <?= $chapter->creationDate() ?><?php
                if($chapter->editDate() !== NULL){
                    ?>
                    - Modifié le <?= $chapter->editDate() ?>
                <?php
                }
                ?>
            </h4>
            <img src="<?= HOST; ?>images/<?= $chapter->id() ?>.jpg">
            <p class="extractChapter">
                <?php
                $tab = explode(' ', $chapter->content(), (LIMIT+1));
                if(count($tab) > LIMIT){array_pop($tab); }
                echo nl2br(implode(' ', $tab)); ?><a href="index.php?action=chapter&amp;id=<?= $chapter->id() ?>" class="clickExcerptAdmin">...cliquez ici pour lire la suite</a>
                <br />
            </p>
        </div>
    <?php
    }
    ?>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>