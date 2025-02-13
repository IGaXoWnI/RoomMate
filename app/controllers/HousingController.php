<?php

class HousingController extends BaseController {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function showPostHousingForm() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login first";
            header('Location: /login');
            exit;
        }
        $this->render('housing/post-housing');
    }

    public function handlePostHousing() {
    }

    public function store() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<pre>";
            print_r($_POST);
            print_r($_FILES);
            echo "</pre>";

            $address = trim($_POST['address'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $neighborhood = trim($_POST['neighborhood'] ?? '');
            $rent = floatval($_POST['rent'] ?? 0);
            $capacity = intval($_POST['capacity'] ?? 0);
            $availability_date = $_POST['availability_date'] ?? date('Y-m-d');
            $amenities = isset($_POST['amenities']) ? implode(',', $_POST['amenities']) : '';
            $rules = trim($_POST['rules'] ?? '');
            $user_id = $_SESSION['user_id'] ?? null;

            if (!$address || !$city || !$rent || !$capacity || !$user_id) {
                $_SESSION['error'] = "All required fields must be filled out";
                header('Location: /post-housing');
                exit;
            }

            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $photos = [];
            if (isset($_FILES['photos'])) {
                foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['photos']['error'][$key] === 0) {
                        $filename = uniqid() . '_' . $_FILES['photos']['name'][$key];
                        $filepath = $uploadDir . $filename;
                        
                        if (move_uploaded_file($tmp_name, $filepath)) {
                            $photos[] = $filename;
                        } else {
                            $_SESSION['error'] = "Error uploading file: " . $_FILES['photos']['name'][$key];
                            header('Location: /post-housing');
                            exit;
                        }
                    }
                }
            }
            $photos_string = implode(',', $photos);

            try {
                $location = "$address, $neighborhood, $city";
                echo "About to execute SQL with: <br>";
                echo "User ID: $user_id <br>";
                echo "Location: $location <br>";
                echo "Rent: $rent <br>";
                echo "Capacity: $capacity <br>";

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
                    ':user_id' => $user_id,
                    ':location' => $location,
                    ':rent' => $rent,
                    ':capacity' => $capacity,
                    ':amenities' => $amenities,
                    ':rules' => $rules,
                    ':photos' => $photos_string,
                    ':availability' => $availability_date
                ];

                echo "<pre>";
                print_r($params);
                echo "</pre>";

                $result = $stmt->execute($params);

                if ($result) {
                    $_SESSION['success'] = "Annonce publiée avec succès!";
                    header('Location: /home');
                    exit;
                } else {
                    print_r($stmt->errorInfo());
                    throw new Exception("Failed to insert data");
                }

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                echo "<pre>";
                print_r($e->getTrace());
                echo "</pre>";
                
                $_SESSION['error'] = "Erreur lors de la publication: " . $e->getMessage();
                header('Location: /post-housing');
                exit;
            }
        }
    }
} 