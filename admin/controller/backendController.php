<?php

require_once(MODEL.'/ChapterManager.php');
require_once(MODEL.'/CommentManager.php');
require_once(MODEL.'/UserManager.php');

function loginAdmin()
{
    require(ADMINVIEW.'/connexionView.php');
}

function connectOK($pseudo, $pass)
{
    $userManager = new UserManager();
    $loggedUser = $userManager->getUser($pseudo);

    if($_POST['pseudo'] === $loggedUser->pseudo() && $_POST['password'] === $loggedUser->pass())
    {
        $userManager = new UserManager();
        $loggedUser = $userManager->getUser($pseudo);
        
        $chapterManager = new ChapterManager(); 
        $chapters = $chapterManager->getChapters(); 
        $nbChapters = $chapterManager->countChapters(); 

        $commentManager = new CommentManager();
        $commentsToModerate = $commentManager->countCommentsToModerate();
        $nbComments = $commentManager->countComments();
        $nbEditedComments = $commentManager->countModeratedComments();

        $_SESSION['id'] = $loggedUser->id();
        $_SESSION['pseudo'] = $loggedUser->pseudo();

        require(ADMINVIEW.'/homeAdminView.php');
    }
    else
    {
        throw new Exception('Votre identifiant ou mot de passe est erroné !');
    }
}

function homeAdmin() {

    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters(); 
    $nbChapters = $chapterManager->countChapters(); 
    $commentManager = new CommentManager();
    $commentsToModerate = $commentManager->countCommentsToModerate();
    $nbComments = $commentManager->countComments();
    $nbEditedComments = $commentManager->countModeratedComments();
    require(ADMINVIEW.'/homeAdminView.php');
}

// Déconnexion

function deconnexion()
{
    $_SESSION = array();
    session_destroy();

    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters(); 
    
    require(FRONTVIEW.'/listChaptersView.php');
}


