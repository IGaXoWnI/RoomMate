<?php
require_once __DIR__ . '/../models/Housing.php';

class HousingController extends BaseController {
    private $housingModel;

    public function __construct() {
        $this->housingModel = new Housing();
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        try {
            $data = [
                'address' => trim($_POST['address'] ?? ''),
                'city' => trim($_POST['city'] ?? ''),
                'neighborhood' => trim($_POST['neighborhood'] ?? ''),
                'rent' => floatval($_POST['rent'] ?? 0),
                'capacity' => intval($_POST['capacity'] ?? 0),
                'availability_date' => $_POST['availability_date'] ?? date('Y-m-d'),
                'amenities' => isset($_POST['amenities']) ? implode(',', $_POST['amenities']) : '',
                'rules' => trim($_POST['rules'] ?? ''),
                'user_id' => $_SESSION['user_id'] ?? null
            ];

            if (!$data['address'] || !$data['city'] || !$data['rent'] || !$data['capacity'] || !$data['user_id']) {
                $_SESSION['error'] = "All required fields must be filled out";
                header('Location: /post-housing');
                exit;
            }

            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $photos = $this->housingModel->uploadPhotos($_FILES['photos'] ?? [], $uploadDir);
            
            if ($this->housingModel->create($data, $photos)) {
                $_SESSION['success'] = "Annonce publiée avec succès!";
                header('Location: /home');
                exit;
            } else {
                throw new Exception("Failed to insert data");
            }

        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur lors de la publication: " . $e->getMessage();
            header('Location: /post-housing');
            exit;
        }
    }
} 