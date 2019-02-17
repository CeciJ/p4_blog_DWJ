<?php
include_once('config.php');

require(FRONTCONTROLLER.'frontendController.php');
require(ADMINCONTROLLER.'backendController.php');

// Utilisation et démarrage des sessions
session_start();

try {
    
    // FRONT
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listChapters') {
            listChapters();
        }
        elseif ($_GET['action'] == 'chapter') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                chapter();
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
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
        elseif ($_GET['action'] == 'reportComment') {
            
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                reportComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'legalMentions')
        {
            legalMentions();
        }

        //ADMIN
        elseif ($_GET['action'] == 'login') {
            loginAdmin();
        }
        elseif ($_GET['action'] == 'connectOK') {
            connectOK($_POST['pseudo'], $_POST['password']);
        }
        elseif (!empty($_SESSION['pseudo'])) {
            // Page d'accueil Admin
            if ($_GET['action'] == 'homeAdmin') {
                homeAdmin();
            }
            // Déconnexion
            elseif ($_GET['action'] == 'deconnect') {
                deconnexion();
            }
            // Ajouter un chapitre
            elseif ($_GET['action'] == 'addChapter') {
                if (isset($_POST['title'])) {
                    addNewChapter($_POST['title'], $_POST['content']);
                }
                else {
                    goToAddChapter();
                }
            }
            // Voir chapitres pour modifier ou supprimer
            elseif ($_GET['action'] == 'listAllChapters') {
                listAllChapters();
            }
            elseif ($_GET['action'] == 'chapterAdmin') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    chapterAdmin();
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
            }
            elseif ($_GET['action'] == 'editChapter') {
                if (isset($_GET['id']) && isset($_POST['newTitle'])) {
                    editChapter($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
                }
                else {
                    getChapterToEdit($_GET['id']);
                }
            }
            elseif ($_GET['action'] == 'delete') {
                deleteChapter($_GET['id']);
            }
            // Modérer commentaires
            elseif ($_GET['action'] == 'getCommentsToModerate') {
                getCommentsToModerate();
            }
            /*elseif ($_GET['action'] == 'goToEditComment'){}*/
            elseif ($_GET['action'] == 'editComment') {
                if(isset($_GET['id']) && isset($_POST['newTitle']) && isset($_POST['newContent'])){
                    editComment($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
                }
                else{
                    goToEditComment($_GET['id']);
                }    
            }
            elseif ($_GET['action'] == 'deleteComment') {
                deleteComment($_GET['id']);
            }
            // Gestion des utilisateurs
            elseif ($_GET['action'] == 'newUser') {
                if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass']))
                {
                    newUser($_POST['pseudo'], $_POST['mail'], $_POST['pass']);
                }
                else
                {
                    goToAddUser();
                }
            }
            elseif ($_GET['action'] == 'listUsers') {
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