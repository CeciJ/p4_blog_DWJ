<?php

class Chapter
{
    protected $id;
    protected $title;
    protected $content;
    protected $creationDate;
    protected $editDate;
    protected $nbComments;

    // GETTERS

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function creationDate()
    {
        return $this->creationDate;
    }

    public function editDate()
    {
        return $this->editDate;
    }

    public function nbComments()
    {
        return $this->nbComments;
    }

    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;
    }

    public function setNbComments($nbComments)
    {
        $this->nbComments = $nbComments;
    }

}