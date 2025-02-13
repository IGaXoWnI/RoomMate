<?php 
require_once(__DIR__.'/../config/db.php');
class Admin extends Db {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers() {
    $sql = "SELECT * FROM Utilisateur ORDER BY id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll();
    }


    public function updateUserRole($userId, $newRole) {
        $sql = "UPDATE utilisateur SET role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            ':role' => $newRole,
            ':id' => $userId
        ]);
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM Utilisateur WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([':id' => $userId]);
    }

}