<?php 
$title = 'Ajouter un chapitre';
ob_start(); 
?> 

    <div class="sectionAddChapter">   
        <h1>Ajouter un chapitre</h1><br/>
        
        <form action="<?php echo HOST; ?>addChapter" method="post" enctype="multipart/form-data">
            <div>
                <label for="title">Titre du chapitre : 
                    <input type="text" id="title" name="title"/>
                </label>
            </div>
            <div>
                <label for="photo">Photo du chapitre
                    <span id="photoWeigth">(Poids maximum autorisé : 2 Mo) :</span><br/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                    <input type="file" id="photo" name="photo"/>
                </label> 
            </div>
            <div>
                <label for="content">Contenu : </label>
                <textarea id="contentNewChapter" name="content" rows="15" cols="100"></textarea>
            </div>
            <div>
                <input type="submit" />    
            </div>
        </form>

    </div>

<?php 
$content = ob_get_clean();
require('templateAdmin.php'); 
