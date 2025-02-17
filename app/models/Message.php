<?php
class Message {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function getConversations($userId) {
        $sql = "SELECT DISTINCT 
                    u.id, 
                    u.username,
                    u.photo_profil,
                    (SELECT contenu 
                     FROM Message 
                     WHERE (expediteur_id = :userId AND destinataire_id = u.id) 
                        OR (expediteur_id = u.id AND destinataire_id = :userId) 
                     ORDER BY date_envoi DESC 
                     LIMIT 1) as dernier_message,
                    (SELECT date_envoi 
                     FROM Message 
                     WHERE (expediteur_id = :userId AND destinataire_id = u.id) 
                        OR (expediteur_id = u.id AND destinataire_id = :userId) 
                     ORDER BY date_envoi DESC 
                     LIMIT 1) as derniere_date
                FROM Message m
                JOIN Utilisateur u ON (m.expediteur_id = u.id OR m.destinataire_id = u.id)
                WHERE (m.expediteur_id = :userId OR m.destinataire_id = :userId)
                    AND u.id != :userId
                ORDER BY derniere_date DESC";

        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessages($userId1, $userId2) {
        $sql = "SELECT m.*, 
                       u1.username as expediteur_username,
                       u2.username as destinataire_username
                FROM Message m
                JOIN Utilisateur u1 ON m.expediteur_id = u1.id
                JOIN Utilisateur u2 ON m.destinataire_id = u2.id
                WHERE (m.expediteur_id = :user1 AND m.destinataire_id = :user2)
                   OR (m.expediteur_id = :user2 AND m.destinataire_id = :user1)
                ORDER BY m.date_envoi ASC";
        
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute([
            'user1' => $userId1,
            'user2' => $userId2
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveMessage($expediteurId, $destinataireId, $contenu) {
        $sql = "INSERT INTO Message (expediteur_id, destinataire_id, contenu) 
                VALUES (:expediteur_id, :destinataire_id, :contenu)";
        
        $stmt = $this->db->conn->prepare($sql);
        $success = $stmt->execute([
            'expediteur_id' => $expediteurId,
            'destinataire_id' => $destinataireId,
            'contenu' => $contenu
        ]);

        if ($success) {
            return $this->db->conn->lastInsertId();
        }
        return false;
    }
} 