<?php 
require_once(__DIR__.'/../config/db.php');
class User extends Db {

public function __construct()
{
    parent::__construct();
}

public function register($user) {
        $result = $this->conn->prepare("INSERT INTO utilisateur (username,email, mot_de_passe,annee_etudes, role) VALUES (?, ?,?, ?, ?)");
        $result->execute($user);
        return true;
}

public function login($userData){
        $result = $this->conn->prepare("SELECT * FROM utilisateur WHERE email=?");
        $result->execute([$userData[0]]);
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($userData[1], $user["mot_de_passe"])){
           return  $user ;
        }
}


public function getUserData($id){
    $result = $this->conn->prepare("select * from utilisateur where id = ?");
    $result->execute([$id]);
    return $result->fetch(PDO::FETCH_ASSOC);
}

}