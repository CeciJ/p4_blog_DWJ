<?php

require_once(MODEL.'/ChapterManager.php');
require_once(MODEL.'/CommentManager.php');

/**
 * First function to go to the welcome page
 */
function homepage()
{
    require(FRONTVIEW.'/homepageView.php');
}

/**
 * To get and list all the chapters, with order parameter by rising or decreasing order
 */
function listChapters(string $order = null)
{
    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters($order); 

    require(FRONTVIEW.'/listChaptersView.php');
}

/**
 * To get a specific chapter
 */
function chapter()
{
    $chapterManager = new ChapterManager();
    $lastChapter = $chapterManager->lastIdRegistered();
    $chapter = $chapterManager->getChapter($_GET['id']);
    
    if(!is_null($chapter) && ($chapter->nbComments() > 0))
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($_GET['id']);
    }

    if (($_GET['id'] > $lastChapter) OR !isset($chapter)) 
    {
        throw new Exception('Ce chapitre n\'existe pas!');
    }
 
    require(FRONTVIEW.'/chapterView.php');
}

/**
 * To get the correct URL (the previous ID of the current chapter) to activate the "Prev Chapter" button
 */
function prevChapter()
{
    $chapterManager = new ChapterManager(); 
    $chaptersListId = $chapterManager->getIdChapters();
    $currentChapter = $_GET['id']; 
    $keyChapter = array_search($currentChapter, $chaptersListId);
    $prevChapter = $keyChapter - 1;

    if($prevChapter > -1){
        header('Location: '.HOST.'chapter-'.$chaptersListId[$prevChapter]);
    }
    else{
        header('Location: '.HOST.'chapter-'. $currentChapter);
    }
}

/**
 * To get the correct URL (the next ID of the current chapter) to activate the "Next Chapter" button
 */
function nextChapter()
{
    $chapterManager = new ChapterManager(); 
    $chaptersListId = $chapterManager->getIdChapters();
    $currentChapter = $_GET['id']; 
    $keyChapter = array_search($currentChapter, $chaptersListId);
    $nextChapter = $keyChapter + 1;
    $allKeys = array_keys($chaptersListId);
    $lastId = end($allKeys);

    if($nextChapter <= $lastId){
        header('Location: '.HOST.'chapter-'. $chaptersListId[$nextChapter]);
    }
    else{
        header('Location: '.HOST.'chapter-'. $currentChapter);
    }
}

/**
 * To add a comment to a chapter
 */
function addComment(int $chapterId, string $title, string $author, string $content)
{
    $commentManager = new CommentManager();
    $newComment = $commentManager->addComment($chapterId, $title, $author, $content);
    
    $chapterManager = new ChapterManager();
    $lastChapter = $chapterManager->lastIdRegistered();
    $chapter = $chapterManager->getChapter($_GET['id']);

    if (($_GET['id'] > $lastChapter) OR !isset($chapter)) 
    {
        throw new Exception('Ce chapitre n\'existe pas!');
    }

    if(!is_null($chapter) && ($chapter->nbComments() > 0))
    {
        $comments = $commentManager->getComments($_GET['id']);
    }
    
    require(FRONTVIEW.'/chapterView.php');
}

/**
 * To report a comment
 */
function reportComment(int $commentId, int $chapterId)
{
    $commentManager = new CommentManager();
    $reportedComment = $commentManager->reportComment($_GET['id']);
 
    $chapterManager = new ChapterManager(); 
    $chapter = $chapterManager->getChapter($chapterId);

    if(!is_null($chapter) && ($chapter->nbComments() > 0))
    {
        $comments = $commentManager->getComments($chapterId);
    }

    require(FRONTVIEW.'/chapterView.php');
}

/**
 * To go and see legalMentions
 */
function legalMentions()
{
    require(FRONTVIEW.'/legalMentionsView.php');
}