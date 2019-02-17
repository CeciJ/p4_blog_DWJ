<?php

//namespace CJ\p4\Model;

require_once(MODEL."/Manager.php");
require_once(MODEL."/Chapter.php");

class ChapterManager extends Manager
{
    public function getChapters()
    {
        $db = $this->dbConnect();

        $req = $db->query('
            SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y\') AS creationDateFr, DATE_FORMAT(editDate, \'%d/%m/%Y\') AS editDateFr, nbComments
            FROM chapters 
            ORDER BY creationDate 
        ');
        //var_dump($req);

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $chapter = new Chapter();
            $chapter->setId($data['id']);
            $chapter->setTitle($data['title']);
            $chapter->setContent($data['content']);
            $chapter->setCreationDate($data['creationDateFr']);
            $chapter->setEditDate($data['editDateFr']);
            $chapter->setNbComments($data['nbComments']);

            $chapters[] = $chapter; // Tableau d'objets
        }
        //var_dump($chapters);
        return $chapters;
    }

    public function countChapters()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT COUNT(id) FROM chapters');
        $nbChapters = $req->fetchColumn();

        return $nbChapters;
    }

    public function getCommentsChapters($chapterId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM comments WHERE chapter = ?');
        $req->execute(array($chapterId));
        //var_dump($req);
        $result = $req->rowcount();
        //echo '<br/> Résultat de la requête : ';
        //var_dump($result); exit;

        $nbComments = $db->prepare('UPDATE chapters SET nbComments = :nbComments WHERE id = :id');
        $nbComments->execute(array(
            'nbComments' => $result,  
            'id' => $chapterId
        ));
        //return $nbComments;
    }

    public function getChapter($chapterId)
    {
        $db = $this->dbConnect();
        self::getCommentsChapters($chapterId);

        $req = $db->prepare('
            SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y\') AS creationDateFr, DATE_FORMAT(editDate, \'%d/%m/%Y\') AS editDateFr, nbComments 
            FROM chapters 
            WHERE id = ?');

        $req->execute(array($chapterId));

        while($data = $req->fetch()){
            $chapter = new Chapter();
            $chapter->setId($data['id']);
            $chapter->setTitle($data['title']);
            $chapter->setContent($data['content']);
            $chapter->setCreationDate($data['creationDateFr']);
            $chapter->setEditDate($data['editDateFr']);
            $chapter->setNbComments($data['nbComments']);
        }

        //var_dump($chapter); // Objet
        return $chapter;
    }

    public function addChapter($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
            INSERT INTO chapters(title, content, creationDate) 
            VALUES(:title, :content, NOW())');
        $req->execute(array(
            'title' => $title, 
            'content' => $content
        ));
    }

    public function editChapter($chapterId, $newTitle, $newContent)
    {
        $db = $this->dbConnect();
        $editChapter = $db->prepare('
            UPDATE chapters 
            SET title = :newTitle, content = :newContent, editDate = NOW() 
            WHERE id = :id');

        $editChapter->execute(array(
            'newTitle' => $newTitle,  
            'newContent' => $newContent, 
            'id' => $chapterId
            ));

        return $editChapter;
    }

    public function delete($chapterId)
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM chapters WHERE id = '.$chapterId);
    }

    public function deleteFromChapters($chapterId)
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM comments WHERE chapter = '. $chapterId);
    }
}

