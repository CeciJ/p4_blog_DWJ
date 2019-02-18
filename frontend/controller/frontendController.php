<?php

require_once(MODEL.'/ChapterManager.php');
require_once(MODEL.'/CommentManager.php');

function listChapters()
{
    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters(); 

    require(FRONTVIEW.'/listChaptersView.php');
}

function chapter()
{
    $chapterManager = new ChapterManager();
    $chapter = $chapterManager->getChapter($_GET['id']);

    $commentManager = new CommentManager();
    if ($chapter->nbComments() > 0){
        $comments = $commentManager->getComments($_GET['id']);
    }

    require(FRONTVIEW.'/chapterView.php');
}

function addComment($chapterId, $title, $author, $content)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->addComment($chapterId, $title, $author, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=chapter&id=' . $chapterId);
    }
}

function reportComment($commentId, $chapterId)
{
    $commentManager = new CommentManager();
    $reportedComment = $commentManager->reportComment($_GET['id']);
    if ($reportedComment === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }

    $chapterManager = new ChapterManager(); 
    $chapters = $chapterManager->getChapters();

    header('Location: index.php?action=chapter&id=' . $chapterId);
}

function legalMentions()
{
    require(FRONTVIEW.'/legalMentionsView.php');
}