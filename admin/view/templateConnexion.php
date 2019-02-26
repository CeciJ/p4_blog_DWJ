<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title ?></title>
       
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        
        <!--Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Caveat|Nothing+You+Could+Do" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        
        <!--All CSS-->
        <link href="<?php echo ASSETS; ?>css/allStyle.css" rel="stylesheet" />
    </head>
        
    <body>

        <div class="page">
            <header>
                <h1 id="bigTitle" class="titleConnexion"><a href="<?php echo HOST; ?>login">Ma plateforme d'administration<br><span id="titleBookConnexion">Billet simple pour l'Alaska</span></a></h1>
            </header>
            
            <br><br>
            <main id="contentConnexion">
                <?= $content ?>
            </main>

            <footer class="homepage">
                <div class="row justify-content-end">
                    <div class="col-6"><a href="<?php echo HOST; ?>legalMentions" id="legalMentions">Mentions légales</a></div> 
                    <div class="col-6 reservedRights">Tous droits réservés 2019</div>
                </div>
            </footer>
        </div>

        <!--Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>