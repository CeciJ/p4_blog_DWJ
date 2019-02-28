<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/Chapter.php");

class ChapterManager extends Manager
{
    // To show all chapters
    public function getChapters($order = null)
    {
        $db = $this->dbConnect();

        if($order == 'DESC'){
            $order = 'DESC';
        } else {
            $order = 'ASC';
        };

        $req = $db->query('
            SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y\') AS creationDateFr, DATE_FORMAT(editDate, \'%d/%m/%Y\') AS editDateFr, nbComments
            FROM chapters 
            ORDER BY creationDate '.$order
        );

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $chapter = new Chapter();
            $chapter->setId($data['id']);
            $chapter->setTitle($data['title']);
            $chapter->setContent($data['content']);
            $chapter->setCreationDate($data['creationDateFr']);
            $chapter->setEditDate($data['editDateFr']);
            $chapter->setNbComments($data['nbComments']);

            $chapters[] = $chapter;
        }

        return $chapters;
    }

    // To get an array with all Id Chapters for next and prev functions in controllers
    public function getIdChapters()
    {
        $db = $this->dbConnect();

        $req = $db->query('
            SELECT id, title
            FROM chapters 
        ');

        $tab = array();

        while ($donnees = $req->fetch())
        {
            array_push($tab, $donnees['id']);
        }

        return $tab;
    }

    // To count how many chapters in db
    public function countChapters()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT COUNT(id) FROM chapters');
        $nbChapters = $req->fetchColumn();

        return $nbChapters;
    }

    // To know how many comments are there by chapter. This function is called in getChapter($chapterId) function.
    public function getCommentsChapters($chapterId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT * FROM comments WHERE chapter = ?');
        $req->execute(array($chapterId));
        $result = $req->rowcount();

        $nbComments = $db->prepare('UPDATE chapters SET nbComments = :nbComments WHERE id = :id');
        $nbComments->execute(array(
            'nbComments' => $result,  
            'id' => $chapterId
        ));
    }

    // To get a chapter by Id
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

        return $chapter;
    }

    // To add a chapter
    public function addChapter($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
            INSERT INTO chapters(title, content, creationDate) 
            VALUES(:title, :content, NOW())');
        $result = $req->execute(array(
            'title' => $title, 
            'content' => $content
        ));

        $lastId = $db->lastInsertId();

        return $lastId;
    }

    // To edit a chapter
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

    // To delete a chapter
    public function delete($chapterId)
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM chapters WHERE id = '.$chapterId);
    }

    // To delete in the database the comments associated to the previously deleted chapter
    public function deleteFromChapters($chapterId)
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM comments WHERE chapter = '. $chapterId);
    }

    // To get the last Id in database
    public function lastIdRegistered()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT MAX(id) AS max_id FROM chapters');
        $result = $req->fetch();

        return $result['max_id'];
    }
}

