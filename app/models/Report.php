<?php
class Report {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function create($data) {
        $sql = "INSERT INTO Signalement (annonce_id, utilisateur_id, raison, statut) 
                VALUES (:annonce_id, :utilisateur_id, :raison, 'En attente')";
        
        $stmt = $this->db->conn->prepare($sql);
        return $stmt->execute([
            ':annonce_id' => $data['annonce_id'],
            ':utilisateur_id' => $data['utilisateur_id'],
            ':raison' => $data['raison']
        ]);
    }

    public function getAllReports() {
        $sql = "SELECT s.*, 
                       a.localisation as annonce_titre,
                       u.username as utilisateur_nom
                FROM Signalement s
                JOIN Annonce a ON s.annonce_id = a.id
                JOIN Utilisateur u ON s.utilisateur_id = u.id
                ORDER BY s.id DESC";
        
        $stmt = $this->db->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE Signalement SET statut = :status WHERE id = :id";
        $stmt = $this->db->conn->prepare($sql);
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }
} 