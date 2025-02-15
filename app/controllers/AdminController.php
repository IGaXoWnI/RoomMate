<?php 
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Admin.php');

class AdminController extends BaseController {
    private $UserModel;
    private $AdminModel;
    public function __construct(){
        $this->UserModel = new User();
        $this->AdminModel = new Admin();
    }
    
    public function showDashboard(){
        
        $users = $this->AdminModel->getAllUsers();
        
        $totalUsers = count($users);
        
        $adminCount = 0;
        $youcoderCount = 0;
        foreach($users as $user) {
            if($user['role'] === 'admin') {
                $adminCount++;
            } else {
                $youcoderCount++;
            }
        }

        $this->render('admin/dashboard', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'youcoderCount' => $youcoderCount
        ]);
    }

    public function updateRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['role'])) {
            $userId = $_POST['user_id'];
            $newRole = $_POST['role'];
            
            $success = $this->AdminModel->updateUserRole($userId, $newRole);
            
            if ($success) {
                header('Location: /dashboard?success=role_updated');
                exit;
            } else {
                header('Location: /dashboard?error=update_failed');
                exit;
            }
        }
    }

    public function deleteUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = $_POST['user_id'];
            
            // Supprimer l'utilisateur
            $success = $this->AdminModel->deleteUser($userId);
            
            if ($success) {
                header('Location: /dashboard?success=user_deleted');
                exit;
            } else {
                header('Location: /dashboard?error=delete_failed');
                exit;
            }
        }
    }

    public function showAnnonce() {
        
        $annonces = $this->AdminModel->getAllAnnonces();
        
        $totalAnnonces = count($annonces);
        $activeAnnonces = 0;
        $pendingAnnonces = 0;
        
        foreach($annonces as $annonce) {
            if($annonce['statut'] === 'active') {
                $activeAnnonces++;
            } elseif($annonce['statut'] === 'inactif') {
                $pendingAnnonces++;
            }
        }
        
        $data = [
            'annonces' => $annonces,
            'totalAnnonces' => $totalAnnonces,
            'activeAnnonces' => $activeAnnonces,
            'pendingAnnonces' => $pendingAnnonces
        ];

        $this->render('admin/annonce', $data);
    }

    public function updateAnnonceStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annonce_id']) && isset($_POST['statut'])) {
            $annonceId = $_POST['annonce_id'];
            $newStatus = $_POST['statut'];

            $success = $this->AdminModel->updateAnnonceStatus($annonceId, $newStatus);
            
            if ($success) {
                header('Location: /dashboard/annonce?success=status_updated');
                exit;
            } else {
                header('Location: /dashboard/annonce?error=update_failed');
                exit;
            }
        }
    }

    public function deleteAnnonce() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annonce_id'])) {
            $annonceId = $_POST['annonce_id'];
            
            $success = $this->AdminModel->deleteAnnonce($annonceId);
            
            if ($success) {
                header('Location: /dashboard/annonce?success=annonce_deleted');
                exit;
            } else {
                header('Location: /dashboard/annonce?error=delete_failed');
                exit;
            }
        }
    }

    public function showSignalements() {
        $signalements = $this->AdminModel->getAllSignalements();
        
        // Compter les différents types de signalements
        $totalSignalements = count($signalements);
        $enAttente = 0;
        $traites = 0;
        $rejetes = 0;
        
        foreach($signalements as $signalement) {
            switch($signalement['statut']) {
                case 'En attente':
                    $enAttente++;
                    break;
                case 'Traité':
                    $traites++;
                    break;
                case 'Rejeté':
                    $rejetes++;
                    break;
            }
        }
        
        $this->render('admin/signalements', [
            'signalements' => $signalements,
            'totalSignalements' => $totalSignalements,
            'enAttente' => $enAttente,
            'traites' => $traites,
            'rejetes' => $rejetes
        ]);
    }

    public function updateSignalementStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signalement_id']) && isset($_POST['statut'])) {
            $signalementId = $_POST['signalement_id'];
            $newStatus = $_POST['statut'];
            
            $success = $this->AdminModel->updateSignalementStatus($signalementId, $newStatus);
            
            if ($success) {
                header('Location: /dashboard/signalements?success=status_updated');
                exit;
            } else {
                header('Location: /dashboard/signalements?error=update_failed');
                exit;
            }
        }
    }
}