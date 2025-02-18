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

    public function getAllAnnonces() {
        $sql = "SELECT a.* , u.username, u.nom_complet 
                FROM Annonce a 
                LEFT JOIN Utilisateur u ON a.utilisateur_id = u.id 
                ORDER BY a.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateAnnonceStatus($annonceId, $status) {
        $sql = "UPDATE Annonce SET statut = :statut WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':statut' => $status,
            ':id' => $annonceId
        ]);
    }

    public function deleteAnnonce($annonceId) {
        $sql = "DELETE FROM Annonce WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $annonceId]);
    }

    public function getAllSignalements() {
        $sql = "SELECT s.*, a.localisation, a.loyer, a.capacite, a.statut as annonce_statut, 
                u.username as signaleur_username, u2.username as annonceur_username 
                FROM Signalement s
                LEFT JOIN Annonce a ON s.annonce_id = a.id
                LEFT JOIN Utilisateur u ON s.utilisateur_id = u.id
                LEFT JOIN Utilisateur u2 ON a.utilisateur_id = u2.id
                ORDER BY s.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateSignalementStatus($signalementId, $status) {
        $sql = "UPDATE Signalement SET statut = :statut WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':statut' => $status,
            ':id' => $signalementId
        ]);
    }

}