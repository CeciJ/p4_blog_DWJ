<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/User.php");

class UserManager extends Manager
{
    public function addUser($pseudo, $mail, $pass)
    {
        $db = $this->dbConnect();
    
        $req = $db->prepare('
            INSERT INTO users(pseudo, mail, pass) 
            VALUES(:pseudo, :mail, :pass)');

        $result = $req->execute(array(
            'pseudo' => $pseudo, 
            'mail' => $mail, 
            'pass' => $pass
        ));

        //var_dump($result);

        return $result;
    }

    public function getUser($pseudo)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('
            SELECT id, pseudo, mail, pass 
            FROM users 
            WHERE pseudo = ?');

        $req->execute(array($pseudo));

        while($data = $req->fetch()){
            $user = new User();
            $user->setId($data['id']);
            $user->setPseudo($data['pseudo']);
            $user->setMail($data['mail']);
            $user->setPass($data['pass']);
        }

        //var_dump($user); // Objet
        return $user;
    }

    public function getUsers()
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('
            SELECT id, pseudo, mail
            FROM users');
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $user = new User();
            $user->setId($data['id']);
            $user->setPseudo($data['pseudo']);
            $user->setMail($data['mail']);

            $users[] = $user; // Tableau d'objets
        }
        return $users;
    }

    public function editUser()
    {
        $db = $this->dbConnect();
        //
    }

    public function deleteUser()
    {
        $db = $this->dbConnect();
        //
    }
}