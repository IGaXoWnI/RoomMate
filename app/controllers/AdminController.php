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
        // Récupérer tous les utilisateurs
        $users = $this->AdminModel->getAllUsers();
        
        // Compter le nombre total d'utilisateurs
        $totalUsers = count($users);
        
        // Compter les admins et youcoders
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
}