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

// Ajouter un chapitre

function goToAddChapter()
{
    require(ADMINVIEW.'/addChapterView.php');
}

function addNewChapter($title, $content)
{
    $chapterManager = new ChapterManager();
    $addedChapter = $chapterManager->addChapter($title, $content);
    $chapters = $chapterManager->getChapters(); // Appel d'une fonction de cet objet
    $nbChapters = $chapterManager->countChapters(); 
    $commentManager = new CommentManager();
    $commentsToModerate = $commentManager->countCommentsToModerate();
    $nbComments = $commentManager->countComments();
    $nbEditedComments = $commentManager->countModeratedComments();

    require(ADMINVIEW.'/homeAdminView.php');
}

// Voir chapitres pour modifier ou supprimer

function listAllChapters()
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters();

    require(ADMINVIEW.'/listAllChaptersView.php');
}

function chapterAdmin()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id']);
    if ($chapter->nbComments() > 0){
        $comments = $commentManager->getComments($_GET['id']);
    }
    
    require(ADMINVIEW.'/chapterAdminView.php');
}

function getChapterToEdit($chapterId)
{
    $chapterManager = new ChapterManager();
    $chapter = $chapterManager->getChapter($_GET['id']);
    require(ADMINVIEW.'/editChapterAdminView.php');
}

function editChapter($chapterId, $newTitle, $newContent)
{
    $chapterManager = new ChapterManager();
    $editedChapter = $chapterManager->editChapter($_GET['id'], $newTitle, $newContent);

    if ($editedChapter === false) {
        throw new Exception('Impossible de modifier le chapitre !');
    }
    else {
        header('Location: index.php?action=chapterAdmin&id=' . $chapterId);
    }
}

function deleteChapter($chapterId)
{
    $chapterManager = new ChapterManager();
    $deletedChapter = $chapterManager->delete($_GET['id']);
    $deletedCommentsChapter = $chapterManager->deleteFromChapters($_GET['id']);

    if ($deletedChapter === false OR $deletedCommentsChapter === false) {
        throw new Exception('Impossible d\'effacer le chapitre et ses commentaires !');
    }
    else {
        header('Location: index.php?action=homeAdmin');
    }
}

// Modérer les commentaires

function getCommentsToModerate()
{
    $commentManager = new CommentManager();
    $commentsToModerate = $commentManager->countCommentsToModerate();
    if($commentsToModerate > 0){
        $commentsToModerate = $commentManager->getCommentsToModerate();
    }
    require(ADMINVIEW.'/commentsToModerateView.php');
}

function goToEditComment($commentId)
{
    $commentManager = new CommentManager();
    $editComment = $commentManager->getComment($_GET['id']);
    //var_dump($editComment);
    require(ADMINVIEW.'/editCommentView.php');
}

function editComment($commentId, $newTitle, $newContent)
{
    $commentManager = new CommentManager();
    $editedComment = $commentManager->editComment($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
    $commentsToModerate = $commentManager->getCommentsToModerate();

    require(ADMINVIEW.'/commentsToModerateView.php');
}

function deleteComment($commentId)
{
    $commentManager = new CommentManager();
    $deletedComment = $commentManager->deleteComment($commentId);
    $commentsToModerate = $commentManager->getCommentsToModerate();

    require(ADMINVIEW.'/commentsToModerateView.php');
}

// Ajouter un Administrateur

function goToAddUser()
{
    require(ADMINVIEW.'/addUserView.php');
}

function newUser($pseudo, $mail, $pass)
{
    $userManager = new UserManager();
    $user = $userManager->addUser($pseudo, $mail, $pass);
    //var_dump($user);
    require(ADMINVIEW.'/addUserView.php');
}

function listUsers()
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();
    //var_dump($users);
    require(ADMINVIEW.'/getUsersView.php');
}


