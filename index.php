<?php
include_once('config.php');

require(FRONTCONTROLLER.'frontendController.php');
require(ADMINCONTROLLER.'backendController.php');

// Utilisation et démarrage des sessions
session_start();

$action = $_GET['action'];
//echo 'l\'action est : '.$action; 

try {
    
    if (isset($_GET['action'])) {

        // FRONT

        if ($action == 'home') {
            listChapters();
        }
        elseif ($action == 'chapter') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                chapter();
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($action == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
                    addComment($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($action == 'reportComment') {  
            if (isset($_GET['id']) && ($_GET['id'] > 0) && isset($_GET['idChapter'])) {
                reportComment(($_GET['id']), ($_GET['idChapter']));
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($action == 'legalMentions')
        {
            legalMentions();
        }

        //ADMIN

        elseif ($action == 'login') {
            loginAdmin();
        }
        elseif ($action == 'connectOK') {
            if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
                    connectOK($_POST['pseudo'], $_POST['password']);
                }
                else
                {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        elseif (!empty($_SESSION['pseudo'])) {
            // Page d'accueil Admin
            if ($action == 'homeAdmin') {
                homeAdmin();
            }
            // Déconnexion
            elseif ($action == 'deconnect') {
                disconnection();
            }
            // Ajouter un chapitre
            elseif ($action == 'addChapter') {
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    if(!empty($_POST['title']) && !empty($_POST['content'])){
                        addNewChapter($_POST['title'], $_POST['content']);
                    }
                    else
                    {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    goToAddChapter();
                }
            }
            // Voir chapitres pour modifier ou supprimer
            elseif ($action == 'listAllChapters') {
                listAllChapters();
            }
            elseif ($action == 'chapterAdmin') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    chapterAdmin();
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
            }
            elseif ($action == 'editChapter') {
                if (isset($_GET['id']) && isset($_POST['newTitle']) && isset($_POST['newContent'])) {
                    if(!empty($_POST['newTitle']) && !empty($_POST['newContent'])){
                        editChapter($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
                    }
                    else
                    {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                elseif (isset($_GET['id'])) {
                    getChapterToEdit($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
            }
            elseif ($action == 'delete') {
                if (isset($_GET['id'])) {
                    deleteChapter($_GET['id']);
                }
            }
            // Modérer commentaires
            elseif ($action == 'getCommentsToModerate') {
                getCommentsToModerate();
            }
            /*elseif ($_GET['action'] == 'goToEditComment'){}*/
            elseif ($action == 'editComment') {
                if (isset($_GET['id']) && isset($_POST['newTitle']) && isset($_POST['newContent'])) {
                    if(!empty($_POST['newTitle']) && !empty($_POST['newContent'])){
                        editComment($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
                    }
                    else
                    {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                elseif (isset($_GET['id'])) {
                    goToEditComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            }
            elseif ($action == 'deleteComment') {
                if (isset($_GET['id'])){
                    deleteComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            }
            // Gestion des utilisateurs
            elseif ($action == 'newUser') {
                if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass']))
                {
                    if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['pass'])){
                        newUser($_POST['pseudo'], $_POST['mail'], $_POST['pass']);
                    }
                    else
                    {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else
                {
                    goToAddUser();
                }
            }
            elseif ($action == 'listUsers') {
                listUsers();
            }
        }
    }
    else {
        listChapters(); // Par défaut page d'accueil frontend
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage();
    require(FRONTVIEW.'/errorView.php');
}