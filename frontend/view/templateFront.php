<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title ?></title>
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        
        <!--DataTables-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>

        <!--Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

        <!--All CSS-->
        <link href="<?= ASSETS; ?>css/allStyle.css" rel="stylesheet" />
    </head>
    <body>
        <div class="page">
            <header>
                <h1 id="bigTitleFrontend"><a href="<?= HOST; ?>listChapters">Billet simple pour l'Alaska</a></h1>
            </header>

            <main>
                <?= $content ?>
            </main>

            <footer class="homepage">
                <div class="row divFooter">
                    <div class="col-6">
                        <a href="<?= HOST; ?>legalMentions" id="legalMentions">Mentions légales</a>
                    </div> 
                    <div class="col-6 divAccessAdmin">
                        <a id="accessAdmin" href="<?= HOST; ?>login">Administration</a>
                    </div>
                    <div class="col-12">Tous droits réservés 2019</div>
                </div>
            </footer>
        </div>

        <!--Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        
        <!--DataTables JS-->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

        <!--Main Front JS-->
        <script src="<?= ASSETS; ?>js/mainFront.js"></script>
    </body>
</html>