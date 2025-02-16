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
    
    public function getAllListings($search = "") {
        if ($search) {
            $sql = "SELECT 
                a.*, 
                u.nom_complet as owner_name, 
                u.username as owner_username, 
                u.email as owner_email, 
                SUBSTRING_INDEX(a.galerie_photos, ',', 1) as main_photo 
            FROM Annonce a 
            JOIN Utilisateur u ON a.utilisateur_id = u.id 
            WHERE a.localisation LIKE :search OR u.nom_complet LIKE :search
            ORDER BY a.id DESC";
    
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute(['search' => "%$search%"]);
        } else {
            $sql = "SELECT 
                a.*, 
                u.nom_complet as owner_name, 
                u.username as owner_username, 
                u.email as owner_email, 
                SUBSTRING_INDEX(a.galerie_photos, ',', 1) as main_photo 
            FROM Annonce a 
            JOIN Utilisateur u ON a.utilisateur_id = u.id 
            ORDER BY a.id DESC";
    
            $stmt = $this->db->conn->query($sql);
        }
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getListingById($id) {
        $sql = "SELECT 
            a.*,
            u.nom_complet as owner_name,
            u.username as owner_username,
            u.email as owner_email,
            u.ville_actuelle as owner_city
        FROM Annonce a
        JOIN Utilisateur u ON a.utilisateur_id = u.id
        WHERE a.id = :id";

        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFilteredListings($filters) {
        try {
            $sql = "SELECT a.*, 
                           u.nom_complet as owner_name, 
                           u.email as owner_email,
                           SUBSTRING_INDEX(a.galerie_photos, ',', 1) as main_photo 
                    FROM Annonce a 
                    JOIN Utilisateur u ON a.utilisateur_id = u.id 
                    WHERE 1=1";
            
            $params = [];

            if (!empty($filters['search'])) {
                $sql .= " AND a.localisation LIKE ?";
                $params[] = "%{$filters['search']}%";
            }

            if (!empty($filters['min_price'])) {
                $sql .= " AND a.loyer >= ?";
                $params[] = $filters['min_price'];
            }

            if (!empty($filters['max_price'])) {
                $sql .= " AND a.loyer <= ?";
                $params[] = $filters['max_price'];
            }

            if (!empty($filters['capacity'])) {
                if ($filters['capacity'] === '4+') {
                    $sql .= " AND a.capacite >= 4";
                } else {
                    $sql .= " AND a.capacite = ?";
                    $params[] = $filters['capacity'];
                }
            }

            if (!empty($filters['amenities'])) {
                foreach ($filters['amenities'] as $amenity) {
                    $sql .= " AND a.equipements LIKE ?";
                    $params[] = "%$amenity%";
                }
            }

            $sql .= " ORDER BY a.id DESC";

            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return [];
        }
    }
} 