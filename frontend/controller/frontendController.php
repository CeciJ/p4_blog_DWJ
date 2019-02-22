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


function prevChapter()
{
    $chapterManager = new ChapterManager(); 
    //J'appelle ma fonction getIdChapters et j'obtiens un tableau de tous les id de chapitres
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

function nextChapter()
{
    $chapterManager = new ChapterManager(); 
    //J'appelle ma fonction getIdChapters et j'obtiens un tableau de tous les id de chapitres
    $chaptersListId = $chapterManager->getIdChapters();
    $currentChapter = $_GET['id']; 
    $keyChapter = array_search($currentChapter, $chaptersListId);
    $nextChapter = $keyChapter + 1;

    //Je récupère la valeur de la dernière clé du tableau
    $allKeys = array_keys($chaptersListId);
    $lastId = end($allKeys);

    if($nextChapter <= $lastId){
        header('Location: '.HOST.'chapter-'. $chaptersListId[$nextChapter]);
    }
    else{
        header('Location: '.HOST.'chapter-'. $currentChapter);
    }
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