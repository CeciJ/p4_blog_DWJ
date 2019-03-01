<?php
include_once('config.php');

require(FRONTCONTROLLER.'frontendController.php');
require(ADMINCONTROLLER.'backendController.php');

session_start();

$action = $_GET['action'];

// FRONT

try {
    
    if (isset($_GET['action'])) {

        if ($action == 'home') {
            homepage();
        }
        elseif ($action == 'listChapters') {
            if (isset($_GET['order'])) {
                listChapters($_GET['order']);
            }
            else 
            {
                listChapters();
            }
        }
        elseif ($action == 'chapter') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                chapter();
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($action == 'prevChapter') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                prevChapter();
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($action == 'nextChapter') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                nextChapter();
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
        elseif ($action == 'legalMentions') {
            legalMentions();
        }

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
                    throw new Exception('Tous les champs pour vous connecter ne sont pas remplis !');
                }
            }
        }
        elseif (!empty($_SESSION['pseudo'])) {
            // Admin Homepage
            if ($action == 'homeAdmin') {
                homeAdmin();
            }
            // Disconnection
            elseif ($action == 'deconnect') {
                disconnection();
            }
            // Add a chapter
            elseif ($action == 'addChapter') {
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    if(!empty($_POST['title']) && !empty($_POST['content'])){
                        if ($_FILES['photo']['error'] < 4){
                            addNewChapter($_POST['title'], $_FILES['photo'], $_POST['content']);
                        }
                        else
                        {
                            throw new Exception('Vous devez joindre une photo !');
                        }
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
            // See chapters to edit or delete
            elseif ($action == 'listAllChapters') {
                if (isset($_GET['order'])) {
                    listAllChapters($_GET['order']);
                }
                else 
                {
                    listAllChapters();
                }
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
            // Control comments
            elseif ($action == 'getCommentsToModerate') {
                getCommentsToModerate();
            }
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
            // Admin users management
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
            elseif($action == 'editUser') {
                if (isset($_GET['id']) && isset($_POST['newPseudo']) && isset($_POST['newMail'])) {
                    if(!empty($_POST['newPseudo']) && !empty($_POST['newMail'])){
                        editUser($_GET['id'], $_POST['newPseudo'], $_POST['newMail']);
                    }
                    else
                    {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                elseif (isset($_GET['id'])) {
                    goToEditUser($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant d\'administrateur envoyé');
                }
            }
            elseif($action == 'deleteUser') {
                if (isset($_GET['id'])){
                    deleteUser($_GET['id']);
                }
            }
        }
        else {
            throw new Exception('Cette page n\'existe pas !');
        }
    }
    else
    {
        homepage();
    }
}
catch(Exception $e) { 
    $errorMessage = $e->getMessage();
    require(FRONTVIEW.'/errorView.php');
}