<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?= $title ?></title>

        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!--Datatables-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>

        <!--Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        
        <!--All CSS-->
        <link href="<?php echo ASSETS; ?>css/allStyle.css" rel="stylesheet" />

        <!--TinyMce-->
        <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=9uyf4ek30xitcw0v12529n8aftz8d8kcu4iku61m0nwef8dc"></script>
    </head>
        
    <body>
        <div class="pageAdmin">
            <header class="headerAdmin">
                <h1 id="bigTitleAdmin" class="titleAdmin">
                    <a href="<?php echo HOST; ?>homeAdmin">Ma plateforme d'administration</a>
                </h1>
                <div class="row justify-content-between container-fluid">
                    <div id="welcomeMsgAdmin" class="col-12 col-sm-10 col-md-10">Bienvenue <strong><?php echo $_SESSION['pseudo']; ?></strong></div>
                    <div id="deconnectAdmin" class="col-4 col-sm-2 col-md-2">
                        <a href="<?php echo HOST; ?>deconnect">Déconnexion</a>
                    </div>
                </div>
            </header>
            
            <br><br>

            <main class="containerAdmin">
                <nav class="menuAdmin">
                    <ul>
                        <li>
                            <a href="<?php echo HOST; ?>homeAdmin">Page d'accueil</a>
                        </li>
                        <li>
                            <a href="<?php echo HOST; ?>addChapter">Publier un nouveau chapitre</a>
                        </li>
                        <li>
                            <a href="<?php echo HOST; ?>listAllChapters">Voir, modifier ou supprimer les chapitres publiés</a>
                        </li>
                        <li>
                            <a href="<?php echo HOST; ?>getCommentsToModerate">Modérer les commentaires signalés</a>
                        </li>
                        <li>
                            <a href="<?php echo HOST; ?>newUser">Ajouter un nouvel administrateur</a>
                        </li>
                        <li>
                            <a href="<?php echo HOST; ?>listUsers">Voir tous les administrateurs</a>
                        </li>
                    </ul>
                </nav>

                <section class="adminSection">
                    <?= $content ?>
                </section>
            </main>

            <footer class="homepage">
                <div class="row divFooter">
                    <div class="col-6">
                        <a href="<?php echo HOST; ?>legalMentions" id="legalMentions">Mentions légales</a>
                    </div> 
                    <div class="col-6 reservedRights">Tous droits réservés 2019</div>
                </div>
            </footer>
        </div>

        <!--Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <!--DataTables-->
        <script src="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

        <!--TinyMce JS-->
        <script src="<?php echo ASSETS; ?>js/fr_FR.js"></script>

        <!--Main Admin JS-->
        <script src="<?php echo ASSETS; ?>js/mainBack.js"></script>
    </body>
</html>