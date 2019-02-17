<?php

// Chargement des classes
require_once(MODEL.'/ChapterManager.php');
require_once(MODEL.'/CommentManager.php');

function listChapters()
{
    $chapterManager = new ChapterManager(); // Création d'un objet
    $chapters = $chapterManager->getChapters(); // Appel d'une fonction de cet objet
    //var_dump($chapters);
    require(FRONTVIEW.'/listChaptersView.php');
}

function chapter()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id']);
    if ($chapter->nbComments() > 0){
        $comments = $commentManager->getComments($_GET['id']);
    }
    //var_dump($comments);
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

function reportComment($commentId)
{
    $commentManager = new CommentManager();
    $reportedComment = $commentManager->reportComment($_GET['id']);
    $chapterManager = new ChapterManager(); // Création d'un objet
    $chapters = $chapterManager->getChapters(); // Appel d'une fonction de cet objet

    require(FRONTVIEW.'/listChaptersView.php');
}