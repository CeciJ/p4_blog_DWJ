<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/Comment.php");

class CommentManager extends Manager
{
    // To gets comments by chapters
    public function getComments($chapterId)
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
        return $comments;
    }

    // To count how many comments are registered in database
    public function countComments()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT COUNT(id) FROM comments');
        $nbComments = $req->fetchColumn();

        return $nbComments;
    }

    // To add a comment 
    public function addComment($chapterId, $title, $author, $content)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
            INSERT INTO comments(chapter, title, author, content, creationDate) 
            VALUES(?, ?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($chapterId, $title, $author, $content));
    }

    // To report a comment. Update "reported" to true in the database
    public function reportComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = TRUE WHERE id ='. $commentId);
        $reportedComment = $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $reportedComment = new Comment();
            $reportedComment->setId($data['id']);
            $reportedComment->setTitle($data['title']);
            $reportedComment->setContent($data['content']);
            $reportedComment->setCreationDate($data['creationDateFr']);
            $reportedComment->setReported($data['reported']);

        }
        return $reportedComment;
    }

    // To count how many comments have been moderated by admins
    public function countModeratedComments()
    {
        $db = $this->dbConnect();

        $req2 = $db->query('SELECT COUNT(id) FROM comments WHERE editDate IS NOT NULL');
        $nbEditedComments = $req2->fetchColumn();

        return $nbEditedComments;
    }

    // To count how many comments must be moderated ("reported" == TRUE in database)
    public function countCommentsToModerate()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT COUNT(id) FROM comments WHERE reported = TRUE');
        $nbComments = $req->fetchColumn();
        
        return $nbComments;
    }

    // To get all the comments to be moderated
    public function getCommentsToModerate()
    {
        $db = $this->dbConnect();

        $req = $db->prepare('
            SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr 
            FROM comments 
            WHERE reported = TRUE
            ORDER BY creationDate DESC');
        $result=$req->execute();
        $result=$req->rowCount();

        if(!is_null($result) && $result > 0){
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
        else
        {
            return false;
        }
        
    }
    
    // To get a specific comment by Id
    public function getComment($commentId)
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
        return $comment;
    }

    // To edit a comment
    public function editComment($commentId, $newTitle, $newContent)
    {
        $db = $this->dbConnect();

        $editComment = $db->prepare('
            UPDATE comments 
            SET title = :newTitle, content = :newContent, editDate = NOW(), reported = FALSE 
            WHERE id = :id'
        );

        $editComment->execute(array(
            'newTitle' => $newTitle,  
            'newContent' => $newContent, 
            'id' => $commentId
        ));

        return $editComment;
    }

    // To delete a comment
    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM comments WHERE id = '.$commentId);
    }

    // To get the last Id in database
    public function lastIdRegistered()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT MAX(id) AS max_id FROM comments');
        $result = $req->fetch();

        return $result['max_id'];
    } 
}