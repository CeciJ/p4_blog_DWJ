<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/User.php");

class UserManager extends Manager
{
    public function addUser($pseudo, $mail, $pass_hache)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('
            INSERT INTO users(pseudo, mail, pass) 
            VALUES(:pseudo, :mail, :pass)');

        $result = $req->execute(array(
            'pseudo' => $pseudo, 
            'mail' => $mail, 
            'pass' => $pass_hache
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

    public function getUserById($id)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('
            SELECT id, pseudo, mail, pass 
            FROM users 
            WHERE id = ?');

        $req->execute(array($id));

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

    public function editUser($userId, $newPseudo, $newMail)
    {
        $db = $this->dbConnect();
        
        $editUser = $db->prepare('
            UPDATE users 
            SET pseudo = :newPseudo, mail = :newMail
            WHERE id = :id');

        $editUser->execute(array(
            'newPseudo' => $newPseudo,  
            'newMail' => $newMail, 
            'id' => $userId
            ));

        return $editUser;
    }

    public function deleteUser($userId)
    {
        $db = $this->dbConnect();
        $db->exec('DELETE FROM users WHERE id = '.$userId);
    }
}