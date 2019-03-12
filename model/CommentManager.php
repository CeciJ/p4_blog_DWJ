<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/Comment.php");

class CommentManager extends Manager
{
    /**
     * To gets comments by chapters
     *
     * @param  int $chapterId
     *
     * @return null|array
     */
    public function getComments(int $chapterId): ?array
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
            SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, DATE_FORMAT(editDate, \'%d/%m/%Y à %Hh%imin%ss\') AS editDateFr, reported
            FROM comments 
            WHERE chapter = ? 
            ORDER BY creationDate DESC');
        $req->execute(array($chapterId));

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $comment = new Comment();
            $comment->setId($data['id']);
            $comment->setTitle($data['title']);
            $comment->setContent($data['content']);
            $comment->setAuthor($data['author']);
            $comment->setCreationDate($data['creationDateFr']);
            $comment->setEditDate($data['editDateFr']);
            $comment->setReported($data['reported']);

            $comments[] = $comment;
        }
        if(!empty($comments)) {
            return $comments;
        } else {
            return null;
        }
    }

    /**
     * To add a comment
     *
     * @param  int $chapterId
     * @param  string $title
     * @param  string $author
     * @param  string $content
     *
     * @return string
     */
    public function addComment(int $chapterId, string $title, string $author, string $content): string
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(chapter, title, author, content, creationDate) VALUES(?, ?, ?, ?, NOW())');
        $newComment = $comments->execute(array($chapterId, $title, $author, $content));

        if($newComment === true) 
        {
            return 'Votre commentaire a bien été ajouté !';
        }
        else
        {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
    }

    /**
     * To report a comment. Update "reported" to true in the database
     *
     * @param  int $commentId
     *
     * @return string
     */
    public function reportComment(int $commentId): string
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = TRUE WHERE id ='. $commentId);
        $reportedComment = $req->execute();

        if ($reportedComment === true) {
            return 'Le commentaire a bien été signalé.';
        }
        else
        {
            throw new Exception('Impossible de signaler le commentaire !');
        }
    }

    /**
     * To count how many comments are registered in database
     *
     * @return int
     */
    public function countComments(): int
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) FROM comments');
        $nbComments = $req->fetchColumn();

        return $nbComments;
    }

    /**
     * To count how many comments have been moderated by admins
     *
     * @return int
     */
    public function countModeratedComments(): int
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) FROM comments WHERE editDate IS NOT NULL');
        $nbEditedComments = $req->fetchColumn();

        return $nbEditedComments;
    }

    /**
     * To count how many comments must be moderated ("reported" == TRUE in database)
     *
     * @return int
     */
    public function countCommentsToModerate(): int
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) FROM comments WHERE reported = TRUE');
        $nbComments = $req->fetchColumn();
        
        return $nbComments;
    }

    /**
     * To get all the comments to be moderated
     *
     * @return null|array
     */
    public function getCommentsToModerate(): ?array
    {
        $db = $this->dbConnect();

        $req = $db->prepare('
            SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr 
            FROM comments 
            WHERE reported = TRUE
            ORDER BY creationDate DESC');
        $result=$req->execute();
        $result=$req->rowCount();

        if ($result === 0) {
            return null;
        }
        else
        {
            while($data = $req->fetch(PDO::FETCH_ASSOC)){

                $comment = new Comment();
                $comment->setId($data['id']);
                $comment->setTitle($data['title']);
                $comment->setContent($data['content']);
                $comment->setAuthor($data['author']);
                $comment->setCreationDate($data['creationDateFr']);
    
                $comments[] = $comment;
            }
    
            return $comments;
        }
    }
    
    /**
     * To get a specific comment by Id
     *
     * @param  int $commentId
     *
     * @return Comment
     */
    public function getComment(int $commentId): ?Comment
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
            SELECT id, chapter, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr 
            FROM comments 
            WHERE id = ? 
            ORDER BY creationDate DESC');
        $req->execute(array($commentId));

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $comment = new Comment();
            $comment->setId($data['id']);
            $comment->setChapter($data['chapter']);
            $comment->setTitle($data['title']);
            $comment->setContent($data['content']);
            $comment->setCreationDate($data['creationDateFr']);

        }

        if(!empty($comment)) {
            return $comment;
        } else {
            return null;
        }
    }

    /**
     * To edit a comment
     *
     * @param  int $commentId
     * @param  string $newTitle
     * @param  string $newContent
     *
     * @return void
     */
    public function editComment(int $commentId, string $newTitle, string $newContent)
    {
        $db = $this->dbConnect();
        $editComment = $db->prepare('
            UPDATE comments 
            SET title = :newTitle, content = :newContent, editDate = NOW(), reported = FALSE 
            WHERE id = :id'
        );

        $result = $editComment->execute(array(
            'newTitle' => $newTitle,  
            'newContent' => $newContent, 
            'id' => $commentId
        ));

        if($result === true) 
        {
            return 'Votre commentaire a bien été modifié !';
        }
        else
        {
            throw new Exception('Impossible de modifier le commentaire !');
        }
    }

    /**
     * To delete a comment
     *
     * @param  int $commentId
     *
     * @return void
     */
    public function deleteComment(int $commentId): string
    {
        $db = $this->dbConnect();
        $result = $db->exec('DELETE FROM comments WHERE id = '.$commentId);
        if($result === 1) 
        {
            return 'Le commentaire a bien été effacé.';
        }
        else
        {
            throw new Exception('Impossible d\'effacer le commentaire !'); 
        }
    }

    /**
     * To get the last Id in database to make controls in controller
     *
     * @return int
     */
    public function lastIdRegistered(): int
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT MAX(id) AS max_id FROM comments');
        $result = $req->fetch();

        return $result['max_id'];
    } 
}