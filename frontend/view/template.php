<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title ?></title>
        <!-- Bootstrap CSS -->
        <link href="<?php echo HOST; ?>bootstrap/css/bootstrap.css" rel="stylesheet" >
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">-->
        <link href="https://fonts.googleapis.com/css?family=Bad+Script|Caveat|Charm|Marck+Script|Nothing+You+Could+Do|Parisienne|Tangerine" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Dosis|Montserrat|Nunito|Quicksand|Raleway|Work+Sans" rel="stylesheet">
        <link href="<?php echo ASSETS; ?>css/allStyle.css" rel="stylesheet" />
    </head>
        
    <body>
        <div class="page">
            <header>
                <a id="accessAdmin" href="index.php?action=login">Admin</a>
                <h1 id="bigTitle"><a href="<?php echo HOST; ?>index.php">Billet simple pour l'Alaska</a></h1>
            </header>

            <main>
                <?= $content ?>
            </main>

            <footer>
                <p><a href="index.php?action=legalMentions">Mentions légales</a> - Tous droits réservés 2019</p>
            </footer>
        </div>
        <!-- Optional JavaScript -->
        <script src="<?php echo ASSETS; ?>js/front.js"></script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->
    </body>
</html>