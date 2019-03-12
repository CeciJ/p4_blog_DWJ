<?php

require_once(MODEL."/Manager.php");
require_once(MODEL."/User.php");

class UserManager extends Manager
{
    // To add a new admin

    public function addUser(string $pseudo, string $mail, string $pass_hache): bool
    {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO users(pseudo, mail, pass) VALUES(:pseudo, :mail, :pass)');

        $result = $req->execute(array(
            'pseudo' => $pseudo, 
            'mail' => $mail, 
            'pass' => $pass_hache
        ));

        return $result;
    }

    // To get a specific admin by pseudo

    public function getUser(string $pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, mail, pass FROM users WHERE pseudo = ?');

        $req->execute(array($pseudo));

        while($data = $req->fetch()){
            $user = new User();
            $user->setId($data['id']);
            $user->setPseudo($data['pseudo']);
            $user->setMail($data['mail']);
            $user->setPass($data['pass']);
        }

        return $user;
    }

    // To get a specific user by Id

    public function getUserById(int $id)
    {
        $db = $this->dbConnect();  
        $req = $db->prepare('SELECT id, pseudo, mail, pass FROM users WHERE id = ?');
        $req->execute(array($id));

        while($data = $req->fetch()){
            $user = new User();
            $user->setId($data['id']);
            $user->setPseudo($data['pseudo']);
            $user->setMail($data['mail']);
            $user->setPass($data['pass']);
        }

        return $user;
    }

    // To get all the admins registered in database

    public function getUsers()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, mail FROM users');
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)){

            $user = new User();
            $user->setId($data['id']);
            $user->setPseudo($data['pseudo']);
            $user->setMail($data['mail']);

            $users[] = $user;
        }
        return $users;
    }

    // To edit admin info

    public function editUser(int $userId, string $newPseudo, string $newMail)
    {
        $db = $this->dbConnect();
        $editUser = $db->prepare('UPDATE users SET pseudo = :newPseudo, mail = :newMail WHERE id = :id');

        $result = $editUser->execute(array(
            'newPseudo' => $newPseudo,  
            'newMail' => $newMail, 
            'id' => $userId
            ));

        if ($result === false) {
            throw new Exception('Impossible de modifier l\'administrateur !');
        }
    }

    // To delete an admin

    public function deleteUser(int $userId)
    {
        $db = $this->dbConnect();
        $result = $db->exec('DELETE FROM users WHERE id = '.$userId);
        if($result === 1) 
        {
            return 'L\'administrateur a bien été effacé.';
        }
        else
        {
            throw new Exception('Impossible d\'effacer l\'administrateur !'); 
        }
    }

    // To get the last Id in database
    
    public function lastIdRegistered()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT MAX(id) AS max_id FROM users');
        $result = $req->fetch();

        return $result['max_id'];
    }
}