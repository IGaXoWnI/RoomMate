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

    public function getUserById($id){
        $result = $this->conn->prepare("select * from utilisateur where id = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($data){
        $result = $this->conn->prepare("update utilisateur set nom_complet=?,email=?,annee_etudes=?,ville_origine=?,ville_actuelle=?,biographie=?,preferences=?,photo_profil=?,budget=? where id=?");
        $result->execute([$data['nom_complet'],$data['email'],$data['annee_etudes'],$data['ville_origine'],$data['ville_actuelle'],$data['biographie'],$data['preferences'],$data['photo_profil'],$data['budget'],$data['id']]);
        return true;
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFirebaseUid($userId, $firebaseUid) {
        $stmt = $this->conn->prepare("UPDATE utilisateur SET firebase_uid = ? WHERE id = ?");
        return $stmt->execute([$firebaseUid, $userId]);
    }

    public function createSocialUser($userData) {
        $stmt = $this->conn->prepare("INSERT INTO utilisateur (username, email, firebase_uid, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $userData['username'],
            $userData['email'],
            $userData['firebase_uid'],
            $userData['role']
        ]);
        return $this->conn->lastInsertId();
    }

}