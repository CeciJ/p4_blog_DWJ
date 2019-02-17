<?php

//namespace CJ\p4\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=p4_blog_ecrivain;charset=utf8', 'root', 'root');
        return $db;
    }
}