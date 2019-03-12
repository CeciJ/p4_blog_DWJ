<?php

require_once(MODEL.'/ChapterManager.php');
require_once(MODEL.'/Chapter.php');
require_once(MODEL.'/CommentManager.php');
require_once(MODEL.'/UserManager.php');
require_once(MODEL.'/ImageManager.php');

/**
 * To identify if there is an active session and send the homeAdmin page or send the connexion page
 */
function loginAdmin()
{
    if(isset($_SESSION['pseudo']))
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
    else
    {
        require(ADMINVIEW.'/connexionView.php');
    }
}

/**
 * To send all the variables to the homeAdmin
 */
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

/**
 * To validate the connection or send error
 */
function connectOK($pseudo, $pass)
{
    $userManager = new UserManager();
    $loggedUser = $userManager->getUser($pseudo);

    try {
        if($loggedUser)
        {
            $isPasswordCorrect = password_verify($_POST['password'], $loggedUser->pass());

            if($_POST['pseudo'] === $loggedUser->pseudo() && $isPasswordCorrect)
            {
                $userManager = new UserManager();
                $loggedUser = $userManager->getUser($pseudo);
                $_SESSION['id'] = $loggedUser->id();
                $_SESSION['pseudo'] = $loggedUser->pseudo();

                homeAdmin();
            }
            else
            {
                $msgErrorConnexion1 = 'Votre identifiant ou mot de passe est erroné !';
                throw new Exception($msgErrorConnexion1);
            } 
        }
        else
        {
            $msgErrorConnexion2 = 'Votre identifiant ou mot de passe est erroné !';
            throw new Exception($msgErrorConnexion2);
        }
    }
    catch(Exception $e) { 
        $errorMessage = $e->getMessage();
        require(FRONTVIEW.'/errorView.php');
    }
}

/**
 * To disconnect and destroy SESSION
 */
function disconnection()
{
    if(!is_null($_SESSION)){
        $_SESSION = array();
        session_destroy();

        $chapterManager = new ChapterManager(); 
        $chapters = $chapterManager->getChapters(); 
        
        header('Location:listChapters');
    }    
}

/**
 * To send the view to add a chapter
 */
function goToAddChapter()
{
    require(ADMINVIEW.'/addChapterView.php');
}

/**
 * To add a new Chapter
 */
function addNewChapter(string $title, array $photo, string $content)
{
    $chapterManager = new ChapterManager();
    $addedChapter = $chapterManager->addChapter($title, $content); // Return added chapter ID 

    // Get the added chapter to assign its ID to the name of the chapter photo 
    $chapter = $chapterManager->getChapter($addedChapter);
    $photo = $_FILES['photo']['tmp_name'];
    $imageManager = new ImageManager($photo);
    $imageManager->resize_to(IMAGE_LARGEUR_MAXI, IMAGE_HAUTEUR_MAXI); 
    $photo_filename = ROOT.'images/'.$chapter->id().'.'.$imageManager->extension();
    $savedPhoto = $imageManager->save_as($photo_filename);

    if ($addedChapter === false) {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else {
        require(ADMINVIEW.'/addChapterView.php');
    }
}

/**
 * See all the chapters in the Admin
 */
function listAllChapters($order = null)
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters($order);

    require(ADMINVIEW.'/listAllChaptersView.php');
}

/**
 * To select a chapter to edit or delete it
 */
function chapterAdmin()
{
    $chapterManager = new ChapterManager();
    $lastChapter = $chapterManager->lastIdRegistered();
    $chapter = $chapterManager->getChapter($_GET['id']);

    if(!is_null($chapter) && ($chapter->nbComments() > 0))
    {
            $commentManager = new CommentManager();
            $comments = $commentManager->getComments($_GET['id']);
    }

    if (($_GET['id'] > $lastChapter) OR empty($chapter)) 
    {
        throw new Exception('Ce chapitre n\'existe pas!');
    }
    
    require(ADMINVIEW.'/chapterAdminView.php');
}

/**
 * To send the view to edit a chapter
 */
function getChapterToEdit(int $chapterId)
{
    $chapterManager = new ChapterManager();
    $lastChapter = $chapterManager->lastIdRegistered();
    $chapter = $chapterManager->getChapter($_GET['id']);

    if (($_GET['id'] > $lastChapter) OR empty($chapter)) 
    {
        throw new Exception('Ce chapitre n\'existe pas!');
    }

    require(ADMINVIEW.'/editChapterView.php');
}

/**
 * To edit the chapter
 */
function editChapter(int $chapterId, string $newTitle, string $newContent)
{
    $chapterManager = new ChapterManager();
    $editedChapter = $chapterManager->editChapter($_GET['id'], $newTitle, $newContent);
    $chapter = $chapterManager->getChapter($_GET['id']);

    require(ADMINVIEW.'/editChapterView.php');
}

/**
 * To delete the Chapter
 */
function deleteChapter(int $chapterId)
{
    $chapterManager = new ChapterManager();
    $lastChapter = $chapterManager->lastIdRegistered();

    if (($_GET['id'] > $lastChapter) OR !isset($_GET['id'])) 
    {
        throw new Exception('Ce chapitre n\'existe pas et ne peut donc pas être effacé !');
    }
    else
    {
        $image = glob(ROOT .'images/' . $chapterId . '*');
        $imageOk = implode($image);
        if(file_exists($imageOk)){
            $image = explode(' ', $imageOk);
            $filename = $image[0];
            $delImage = new ImageManager($filename);
            $msgSuppression = $delImage->delete($filename);
        } 
        $deletedChapter = $chapterManager->deleteChapter($_GET['id']);
        $deletedCommentsChapter = $chapterManager->deleteFromChapters($_GET['id']);

        if ($deletedChapter === false OR $deletedCommentsChapter === false) {
            throw new Exception('Impossible d\'effacer le chapitre et ses commentaires !');
        }

        $chapters = $chapterManager->getChapters();
        require(ADMINVIEW.'/listAllChaptersView.php');
    }
}

/**
 * To send the view of the list of comments to moderate
 */
function getCommentsToModerate()
{
    $commentManager = new CommentManager();
    $commentsToModerate = $commentManager->countCommentsToModerate();
    if($commentsToModerate > 0){
        $commentsToModerate = $commentManager->getCommentsToModerate();
    }

    require(ADMINVIEW.'/commentsToModerateView.php');
}

/**
 * To send the view to edit a reported comment
 */
function goToEditComment(int $commentId)
{
    $commentManager = new CommentManager();
    $lastComment = $commentManager->lastIdRegistered();
    $editComment = $commentManager->getComment($_GET['id']);

    if (($_GET['id'] > $lastComment) OR empty($editComment)) 
    {
        throw new Exception('Ce commentaire n\'existe pas!');
    }

    require(ADMINVIEW.'/editCommentView.php');
}

/**
 * To edit a comment which has been reported
 */
function editComment(int $commentId, string $newTitle, string $newContent)
{
    $commentManager = new CommentManager();
    $lastComment = $commentManager->lastIdRegistered();
    $editedComment = $commentManager->editComment($_GET['id'], $_POST['newTitle'], $_POST['newContent']);
    $commentsToModerate = $commentManager->getCommentsToModerate();
    $msgEditCommentOk = 'Le commentaire a bien été modéré.';

    if($_GET['id'] > $lastComment OR empty($editedComment))
    {
        throw new Exception('Ce commentaire n\'existe pas!');
    }

    require(ADMINVIEW.'/commentsToModerateView.php');
}

/**
 * To delete a comment
 */
function deleteComment(int $commentId)
{
    $commentManager = new CommentManager();
    $lastComment = $commentManager->lastIdRegistered();
    $deletedComment = $commentManager->deleteComment($commentId);
    $commentsToModerate = $commentManager->getCommentsToModerate();
    $msgDelCommentOk = 'Le commentaire a bien été supprimé.';

    if (($_GET['id'] > $lastComment) OR empty($deletedComment)) 
    {
        throw new Exception('Ce chapitre n\'existe pas et ne peut donc pas être effacé !');
    }
    
    require(ADMINVIEW.'/commentsToModerateView.php');
}

/**
 * To send the view to add a user
 */
function goToAddUser()
{
    require(ADMINVIEW.'/addUserView.php');
}

/**
 * To add a new User
 */
function newUser(string $pseudo, string $mail, string $pass)
{
    $userManager = new UserManager();
    $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
    $user = $userManager->addUser($pseudo, $mail, $pass_hache);
    $success = null;

    if ($user === false) {
        throw new Exception('Impossible d\'ajouter le nouvel utilisateur !');
    }
    else {
        $success = 'Le nouvel administrateur a bien été ajouté !';
        require(ADMINVIEW.'/addUserView.php');
    }
}

/**
 * To get all the registered users
 */
function listUsers()
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();

    require(ADMINVIEW.'/listUsersView.php');
}

/**
 * To send the view to edit a user
 */
function goToEditUser(int $userId)
{
    $userManager = new UserManager();
    $lastUser = $userManager->lastIdRegistered();
    $editUser = $userManager->getUserById($userId);

    if (($_GET['id'] > $lastUser) OR empty($editUser)) 
    {
        throw new Exception('Cet administrateur n\'existe pas!');
    }

    require(ADMINVIEW.'/editUserView.php');
}

/**
 * To edit the information of a user
 */
function editUser(int $userId, string $newPseudo, string $newMail)
{
    $userManager = new UserManager();
    $editedUser = $userManager->editUser($userId, $newPseudo, $newMail);
    $users = $userManager->getUsers();
    $msgEditUserOk = 'Les informations de l\'administrateur ont bien été modifiées.';
    require(ADMINVIEW.'/listUsersView.php');

    if ($editedUser === false) {
        throw new Exception('Impossible de modifier l\'administrateur !');
    }
}

function deleteUser(int $userId)
{
    $userManager = new UserManager();
    $lastUser = $userManager->lastIdRegistered();
    $deletedUser = $userManager->deleteUser($userId);
    $success = null;

    if (($_GET['id'] > $lastUser) OR empty($deletedUser)) 
    {
        throw new Exception('Cet administrateur n\'existe pas et ne peut donc pas être effacé !');
    }
    else
    {
        $success = 'L\'administrateur a bien été supprimé';
        $users = $userManager->getUsers();
        require(ADMINVIEW.'/listUsersView.php');
    }
}