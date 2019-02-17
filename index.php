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
            homeAdmin();
        }
        // Déconnexion
        elseif ($_GET['action'] == 'deconnect') {
            deconnexion();
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