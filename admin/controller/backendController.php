<?php

require_once(MODEL.'/ChapterManager.php');
require_once(MODEL.'/CommentManager.php');
require_once(MODEL.'/UserManager.php');
require_once(MODEL.'/ImageManager.php');

// Connection

function loginAdmin()
{
    require(ADMINVIEW.'/connexionView.php');
}

function connectOK($pseudo, $pass)
{
    $userManager = new UserManager();
    $loggedUser = $userManager->getUser($pseudo);

    $isPasswordCorrect = password_verify($_POST['password'], $loggedUser->pass());

    if($_POST['pseudo'] === $loggedUser->pseudo() && $isPasswordCorrect)
    {
        $userManager = new UserManager();
        $loggedUser = $userManager->getUser($pseudo);
        $_SESSION['id'] = $loggedUser->id();
        $_SESSION['pseudo'] = $loggedUser->pseudo();

        $chapterManager = new ChapterManager(); 
        $chapters = $chapterManager->getChapters(); 
        $nbChapters = $chapterManager->countChapters(); 

        $commentManager = new CommentManager();
        $commentsToModerate = $commentManager->countCommentsToModerate();
        $nbComments = $commentManager->countComments();
        $nbEditedComments = $commentManager->countModeratedComments();

        require(ADMINVIEW.'/homeAdminView.php');
    }
    else
    {
        throw new Exception('Votre identifiant ou mot de passe est erroné !');
    }
}

function homeAdmin() 
{
    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters(); 
    $nbChapters = $chapterManager->countChapters(); 

    $commentManager = new CommentManager();
    $commentsToModerate = $commentManager->countCommentsToModerate();
    $nbComments = $commentManager->countComments();
    $nbEditedComments = $commentManager->countModeratedComments();

    require(ADMINVIEW.'/homeAdminView.php');
}

// Disconnection

function disconnection()
{
    $_SESSION = array();
    session_destroy();

    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters(); 
    
    header('Location:home');
}

// Add a chapter

function goToAddChapter()
{
    require(ADMINVIEW.'/addChapterView.php');
}

function addNewChapter($title, $photo, $content)
{
    $chapterManager = new ChapterManager();
    $addedChapter = $chapterManager->addChapter($title, $content); // Return added chapter ID 

    // Get the added chapter to assign its ID to the name of the added photo 
    $chapter = $chapterManager->getChapter($addedChapter);

    // Photo management
    $photo = $_FILES['photo']['tmp_name'];
    $imageManager = new ImageManager($photo);
    $imageManager->resize_to(IMAGE_LARGEUR_MAXI, IMAGE_HAUTEUR_MAXI); 
    $photo_filename = ROOT.'images/'.$chapter->id().'.'.$imageManager->extension();
    $savedPhoto = $imageManager->save_as($photo_filename);

    $chapters = $chapterManager->getChapters(); 
    $nbChapters = $chapterManager->countChapters(); 

    $commentManager = new CommentManager();
    $commentsToModerate = $commentManager->countCommentsToModerate();
    $nbComments = $commentManager->countComments();
    $nbEditedComments = $commentManager->countModeratedComments();

    if ($addedChapter === false) {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else {
        require(ADMINVIEW.'/homeAdminView.php');
    }
}

// See chapters to edit or delete

function listAllChapters()
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters();

    require(ADMINVIEW.'/listAllChaptersView.php');
}

function chapterAdmin()
{
    $chapterManager = new ChapterManager();
    $chapter = $chapterManager->getChapter($_GET['id']);

    $commentManager = new CommentManager();
    if ($chapter->nbComments() > 0){
        $comments = $commentManager->getComments($_GET['id']);
    }
    
    require(ADMINVIEW.'/chapterAdminView.php');
}

function getChapterToEdit($chapterId)
{
    $chapterManager = new ChapterManager();
    $chapter = $chapterManager->getChapter($_GET['id']);

    require(ADMINVIEW.'/editChapterView.php');
}

function editChapter($chapterId, $newTitle, $newContent)
{
    $chapterManager = new ChapterManager();
    $editedChapter = $chapterManager->editChapter($_GET['id'], $newTitle, $newContent);

    if ($editedChapter === false) {
        throw new Exception('Impossible de modifier le chapitre !');
    }
    else {
        header('Location: '.HOST.'chapterAdmin-' . $chapterId);
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
        header('Location: '.HOST.'listAllChapters');
    }
}

// Control of comments

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

    require(ADMINVIEW.'/editCommentView.php');
}

function editComment($commentId, $newTitle, $newContent)
{
    $commentManager = new CommentManager();
    $editedComment = $commentManager->editComment($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
    $commentsToModerate = $commentManager->getCommentsToModerate();

    if ($editedComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        require(ADMINVIEW.'/commentsToModerateView.php');
    }
}

function deleteComment($commentId)
{
    $commentManager = new CommentManager();
    $deletedComment = $commentManager->deleteComment($commentId);
    $commentsToModerate = $commentManager->getCommentsToModerate();

    if ($deletedComment === false) {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else {
        require(ADMINVIEW.'/commentsToModerateView.php');
    }
}

// Management of admins

function goToAddUser()
{
    require(ADMINVIEW.'/addUserView.php');
}

function newUser($pseudo, $mail, $pass)
{
    $userManager = new UserManager();
    $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
    $user = $userManager->addUser($pseudo, $mail, $pass_hache);

    if ($user === false) {
        throw new Exception('Impossible d\'ajouter le nouvel utilisateur !');
    }
    else {
        require(ADMINVIEW.'/addUserView.php');
    }
}

function listUsers()
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();

    require(ADMINVIEW.'/listUsersView.php');
}

function goToEditUser($userId)
{
    $userManager = new UserManager();
    $editUser = $userManager->getUserById($userId);
    //var_dump($editUser);
    require(ADMINVIEW.'/editUserView.php');
}

function editUser($userId, $newPseudo, $newMail)
{
    $userManager = new UserManager();
    $editedUser = $userManager->editUser($userId, $newPseudo, $newMail);

    if ($editedUser === false) {
        throw new Exception('Impossible de modifier l\'administrateur !');
    }
    else {
        header('Location: '.HOST.'listUsers');
    }
}

function deleteUser($userId)
{
    $userManager = new UserManager();
    $deletedUser = $userManager->deleteUser($userId);

    header('Location: '.HOST.'listUsers');
}