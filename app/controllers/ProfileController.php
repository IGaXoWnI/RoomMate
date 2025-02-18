<?php

class ProfileController extends BaseController {
 
    private $UserModel ;

    public function __construct(){
        $this->UserModel = new User();
     }

   public function profile(){
    $user = $this->UserModel->getUserData($_SESSION['user_id']);
    $this->render('youcoder/profile',['user'=>$user]);
   }

   public function updateProfile(){
    if($_SERVER['REQUEST_METHOD']=="POST"){

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                $folderPath = 'assets/images/' . $fileName;

                if (move_uploaded_file($fileTmpName, $folderPath)) {

        $data = [
            'nom_complet' => $_POST['nom_complet'],
            'email' => $_POST['email'],
            'annee_etudes' => $_POST['annee_etudes'],
            'ville_origine' => $_POST['ville_origine'],
            'ville_actuelle' => $_POST['ville_actuelle'],
            'biographie' => $_POST['biographie'],
            'preferences' => $_POST['preferences'],
            'photo_profil' => $folderPath,
            'budget' => $_POST['budget'],
            'id' => $_SESSION['user_id']
        ];

        $this->UserModel->updateUser($data);
        header('location: /profile');
        return;
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Invalid file type. Please upload JPG, PNG, or GIF.";
        }
        } else {
        echo "Please upload a valid image file.";
        }

    }
   }
}
?>