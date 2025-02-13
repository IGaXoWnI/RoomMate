<?php

class Housing {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function create($data, $photos) {
        $location = "{$data['address']}, {$data['neighborhood']}, {$data['city']}";
        $photos_string = implode(',', $photos);

        $sql = "INSERT INTO Annonce (
            type, 
            utilisateur_id, 
            localisation, 
            loyer, 
            capacite, 
            equipements, 
            regles, 
            galerie_photos, 
            disponibilite
        ) VALUES (
            'J\'ai un Logement',
            :user_id,
            :location,
            :rent,
            :capacity,
            :amenities,
            :rules,
            :photos,
            :availability
        )";

        $stmt = $this->db->conn->prepare($sql);
        
        $params = [
            ':user_id' => $data['user_id'],
            ':location' => $location,
            ':rent' => $data['rent'],
            ':capacity' => $data['capacity'],
            ':amenities' => $data['amenities'],
            ':rules' => $data['rules'],
            ':photos' => $photos_string,
            ':availability' => $data['availability_date']
        ];

        return $stmt->execute($params);
    }

    public function uploadPhotos($files, $uploadDir) {
        $photos = [];
        if (!empty($files)) {
            foreach ($files['tmp_name'] as $key => $tmp_name) {
                if ($files['error'][$key] === 0) {
                    $filename = uniqid() . '_' . $files['name'][$key];
                    $filepath = $uploadDir . $filename;
                    
                    if (move_uploaded_file($tmp_name, $filepath)) {
                        $photos[] = $filename;
                    } else {
                        throw new Exception("Error uploading file: " . $files['name'][$key]);
                    }
                }
            }
        }
        return $photos;
    }

    public function getAnoncesData($id){
        $result = $this->db->conn->prepare("select * from Annonce where id = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);

    }
    
    public function getAllListings() {
        $sql = "SELECT 
            a.*,
            u.nom_complet as owner_name,
            u.username as owner_username,
            u.email as owner_email,
            SUBSTRING_INDEX(a.galerie_photos, ',', 1) as main_photo
        FROM Annonce a
        JOIN Utilisateur u ON a.utilisateur_id = u.id
        ORDER BY a.id DESC";

        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 