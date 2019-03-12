<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/Chapter.php");

class ChapterManager extends Manager
{
    /**
     * To get all chapters
     *
     * @param  mixed $order
     *
     * @return array|null
     */
    public function getChapters(?string $order = null): ?array
    {
        $db = $this->dbConnect();

        if($order === 'DESC'){
            $order = 'DESC';
        } else {
            $order = 'ASC';
        };

        $req = $db->prepare('
            SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y\') AS creationDateFr, DATE_FORMAT(editDate, \'%d/%m/%Y\') AS editDateFr, nbComments
            FROM chapters 
            ORDER BY creationDate ' . $order
        );
        $req->execute();

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

        if(!empty($chapters)) {
            return $chapters;
        } else {
            return null;
        }
    }

    /**
     * To get an array with all Id Chapters for next and prev functions in controllers
     *
     * @return array
     */
    public function getIdChapters(): array
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id FROM chapters');
        $tab = array();

        while ($data = $req->fetch())
        {
            array_push($tab, $data['id']);
        }

        return $tab;
    }

    /**
     * To count how many chapters are registered in db
     *
     * @return int
     */
    public function countChapters(): int
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) FROM chapters');
        $nbChapters = $req->fetchColumn();

        return $nbChapters;
    }

    /**
     * To get the last chapter Id registerd in database to make controls in controller
     *
     * @return null|int
     */
    public function lastIdRegistered(): ?int
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT MAX(id) AS max_id FROM chapters');
        $result = $req->fetchColumn();

        if ($result === null) 
        {
            return null;
        }
        else
        {
            return $result;
        }
    }

    /**
     * To know how many comments there are by chapter. This function is called in getChapter($chapterId) function.
     *
     * @param  int $chapterId
     *
     * @return void
     */
    public function getCommentsChapters(int $chapterId): void
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

    /**
     * To get a chapter by Id
     *
     * @param  int $chapterId
     *
     * @return null|Chapter
     */
    public function getChapter(int $chapterId): ?Chapter
    {
        $db = $this->dbConnect();
        self::getCommentsChapters($chapterId);

        $req = $db->prepare('
            SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y\') AS creationDateFr, DATE_FORMAT(editDate, \'%d/%m/%Y\') AS editDateFr, nbComments 
            FROM chapters 
            WHERE id = ?'
        );

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
        
        if(!empty($chapter)) {
            return $chapter;
        } else {
            return null;
        }
    }

    /**
     * To add a chapter and return the last inserted Id to manage the uploaded image
     *
     * @param  string $title
     * @param  string $content
     *
     * @return int
     */
    public function addChapter(string $title, string $content): int
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapters(title, content, creationDate) VALUES(:title, :content, NOW())');
        $result = $req->execute(array(
            'title' => $title, 
            'content' => $content
        ));

        $lastId = $db->lastInsertId();
        return (int)$lastId;
    }

    /**
     * To edit a chapter
     *
     * @param  int $chapterId
     * @param  string $newTitle
     * @param  string $newContent
     *
     * @return string
     */
    public function editChapter(int $chapterId, string $newTitle, string $newContent): string
    {
        $db = $this->dbConnect();
        $editChapter = $db->prepare('
            UPDATE chapters 
            SET title = :newTitle, content = :newContent, editDate = NOW() 
            WHERE id = :id'
        );

        $result = $editChapter->execute(array(
            'newTitle' => $newTitle,  
            'newContent' => $newContent, 
            'id' => $chapterId
            ));
        
        if($result === true) 
        {
            return 'Votre chapitre a bien été modifié !';
        }
        else
        {
            throw new Exception('Impossible de modifier le chapitre !');
        }
    }

    /**
     * To delete a chapter
     *
     * @param  int $chapterId
     *
     * @return string
     */
    public function deleteChapter(int $chapterId): string
    {
        $db = $this->dbConnect();
        $result = $db->exec('DELETE FROM chapters WHERE id = '.$chapterId);
        if($result === 1) 
        {
            return 'Le chapitre a bien été effacé.';
        }
        else
        {
            throw new Exception('Impossible d\'effacer le chapitre !'); 
        }
    }

    /**
     * To delete in the database the comments associated to the previously deleted chapter
     *
     * @param  int $chapterId
     *
     * @return void
     */
    public function deleteFromChapters(int $chapterId): void
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM comments WHERE chapter = '. $chapterId);
    }
}