<?php

class Comment
{
    protected $id;
    protected $chapter;
    protected $title;
    protected $content;
    protected $author;
    protected $creationDate;
    protected $editDate;
    protected $reported;

    // GETTERS

    public function id()
    {
        return $this->id;
    }

    public function chapter()
    {
        return $this->chapter;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function author()
    {
        return $this->author;
    }

    public function creationDate()
    {
        return $this->creationDate;
    }

    public function editDate()
    {
        return $this->editDate;
    }

    public function reported()
    {
        return $this->reported;
    }

    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
    }

    public function setTitle($title)
    {
        /*
        if (!is_string($title) || empty($title))
        {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }
        */

        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;
    }

    public function setReported($reported)
    {
        $this->reported = $reported;
    }
}