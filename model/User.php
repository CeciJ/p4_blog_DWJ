<?php

class User
{
    protected $id;
    protected $pseudo;
    protected $mail;
    protected $pass;

    // GETTERS

    public function id()
    {
        return $this->id;
    }

    public function pseudo()
    {
        return $this->pseudo;
    }

    public function mail()
    {
        return $this->mail;
    }

    public function pass()
    {
        return $this->pass;
    }

    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }
}