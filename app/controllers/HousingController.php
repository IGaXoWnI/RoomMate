<?php
require_once __DIR__ . '/../models/Housing.php';

class HousingController extends BaseController {
    private $housingModel;
    private $UserModel ;

    public function __construct() {
        $this->housingModel = new Housing();
        $this->UserModel = new User();
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

    public function index() {
        $listings = $this->housingModel->getAllListings();
        $this->render('housing/index', ['listings' => $listings]);
    }

    public function show($id) {
        $listing = $this->housingModel->getListingById($id);
        if (!$listing) {
            header('Location: /find-housing');
        }
        $this->Match($id);
        $this->render('housing/show', ['listing' => $listing]);
    }


    public function Match($id){
        $annonce = $this->housingModel->getAnoncesData($id);
        $user = $this->UserModel->getUserData($_SESSION['user_id']);
    
    
        if (!isset($user['budget']) || !isset($user['ville_actuelle']) || !isset($user['preferences']) || empty($user['budget']) || empty($user['ville_actuelle']) || empty($user['preferences'])) {
            $_SESSION['unmatch'] = "Veuillez mettre à jour vos informations de profil pour calculer votre taux de matching.";
        }else{
    
        $score = 0;
    
        if ($user['budget'] >= $annonce['loyer']) {
            $score += 30;
        }
    
        if (str_contains(strtolower($annonce['localisation']), strtolower($user['ville_actuelle']))) {
            $score += 30;
        }
    
        $preferences = explode(',', $user['preferences']);
        $annoncePref = explode(',', $annonce['regles']);
    
        $common_preferences = array_intersect($preferences, $annoncePref);
        if (!empty($common_preferences)) {
            $score += 20;
        }
    
        $today = date('Y-m-d');
        if ($annonce['disponibilite'] >= $today) {
            $score += 20;
        }
    
        if ($score == 0) {
            $_SESSION['unmatch'] = "Cette annonce ne correspond pas à votre profil.";
        } else {
            $_SESSION['match'] = "Cette annonce est un match à " . $score . "% !";
        }}
        
    }
} 