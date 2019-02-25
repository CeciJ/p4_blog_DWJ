<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

        <p id="introWelcomeFrontend">Plongez-vous dès maintenant dans les aventures de ce livre !</p>

        <div id="changeOrdenChapters">
            <form id="changeOrdenChaptersForm" name="OrdenChapters">
                <select name="OrdenChapters" onChange="changeOrdenChapters()">
                    <option value="">Ordre pour voir les chapitres</option>
                    <option value="1" selected="selected">Du plus ancien au plus récent</option>
                    <option value="2">Du plus récent au plus ancien</option>
                </select>
            </form>
        </div>

        <div id="listChapters">

        <?php
            foreach($chapters as $chapter) 
            {
            ?>
                <div class="panelChapter">
                    <h3>
                        <a href="<?php echo HOST; ?>chapter-<?= $chapter->id(); ?>"><?= htmlspecialchars($chapter->title()); ?></a>
                    </h3>
                    <h4>Publié le <?= $chapter->creationDate(); ?><?php
                        if($chapter->editDate() !== NULL){
                            ?>
                            - Modifié le <?= $chapter->editDate(); ?>
                        <?php
                        }
                        ?>
                    </h4>
                    <div class="imgChapter"><img src="<?= HOST; ?>images/<?= $chapter->id(); ?>"></div>
                        <?php
                            $tab = explode(' ', $chapter->content(), (LIMIT+1));
                            if(count($tab) > LIMIT){
                                array_pop($tab); 
                            }
                            $text = implode(' ', $tab);
                        ?>
                        <?php echo $text; ?>
                        <a href="<?php echo HOST; ?>chapter-<?php echo $chapter->id(); ?>" class="clickExcerpt">...cliquez ici pour lire la suite</a>
                </div>
            <?php
            }
            ?>

        </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>