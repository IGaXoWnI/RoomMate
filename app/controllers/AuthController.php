<?php 
require_once (__DIR__.'/../models/User.php');

use PHPmailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';


class AuthController extends BaseController {
 
    private $UserModel ;
   public function __construct(){

      $this->UserModel = new User();
      
    
   }

   public function showRegister() {
      
    $this->render('auth/register');
   }

   public function showOtp(){

    $this->render('auth/otp');
   }

   public function showleLogin() {
      
    $this->render('auth/login');
   }
   
   public function handleRegister(){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];
            $allowedDomain = "gmail.com";
            $emailDomain = substr(strrchr($email, "@"), 1);
        
            if ($emailDomain !== $allowedDomain) {
                $_SESSION['error'] = "Seules les adresses @student.youcode.ma sont autorisées!";
                header('Location: /register');
                exit();
            } elseif (isset($_POST['signup'])) {

             $username = $_POST['username'];
             $email = $_POST['email'];
             $role = $_POST['role'];
             $password = $_POST['password'];
             $annee_etudes = $_POST['annee_etudes'];
             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

             $user = [$username,$email,$hashed_password,$annee_etudes,$role];

              if($this->UserModel->register($user)){
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $message = "Your OTP code is: $otp";
                $mail = new PHPMailer(true);
      
                $mail->isSMTP();                              
                $mail->Host       = 'smtp.gmail.com';       
                $mail->SMTPAuth   = true;             //Enable SMTP authentication
                $mail->Username   = 'badrdine03@gmail.com';   //SMTP write your email
                $mail->Password   = 'rtppygolrobylscs';      //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
                $mail->Port       = 465;                                    
            
                //Recipients
                $mail->setFrom( "roommate@support.com", "Admin"); // Sender Email and name
                $mail->addAddress( $_POST["email"]);     //Add a recipient email  
                $mail->addReplyTo("roommate@support.com", "Admin"); // reply to sender email
            
                //Content
                $mail->isHTML(true);               //Set email format to HTML
                $mail->Subject = "Your OTP Code";   // email subject headings
                $mail->Body    = $message; //email message
                 // Success sent message alert
                $mail->send();  
                header('Location: /otp');
                exit();
              }else{
                $_SESSION['error'] = 'Failed to create account';
                header('Location: /register');
                exit();
              }    
              
         }
     }
   }

   public function handleOtp(){
    if (isset($_POST["OTP"])) {

          if($_SESSION['otp'] == $_POST['code']){
            $_SESSION['success'] = 'Account created successfully! Please login.';
            unset($_SESSION['otp']);
            header('Location: /login');
            exit();
          }else{
            $_SESSION['error'] = 'Wrong Code! Please check your email.';
            header('Location: /otp');
            exit();
          }
          
      }
   }


   public function handleLogin(){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
          if (isset($_POST['login'])) {
              $email = $_POST['email'];
              $password = $_POST['password'];
              $userData = [$email,$password];
              $user = $this->UserModel->login($userData);
             if($user){
                $_SESSION['user_id'] = $user["id"];
                $_SESSION['user_role'] = $user['role'] ; 
                $_SESSION['username'] = $user['username'];

                if ($user['role'] === 'admin') {
                    header('Location: /admin/dashboard.php');
                } else if ($user['role'] === 'youcoder') {
                    header('Location: /home');
                }
             }else{
                $_SESSION['error'] = "Wrong Email or Password, Plaise Try Again!";
                header('Location: /login');
                exit();
             }
          }
      }
 

   }

   public function handleSocialLogin() {
    try {
        // Get JSON data from request
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        if (!$data) {
            throw new Exception('Invalid request data');
        }

        $firebaseUid = $data['firebase_uid'] ?? null;
        $email = $data['email'] ?? null;
        $name = $data['name'] ?? null;
        $provider = $data['provider'] ?? null;

        if (!$firebaseUid || !$email || !$name || !$provider) {
            throw new Exception('Missing required fields');
        }

        // Check if user exists
        $existingUser = $this->UserModel->getUserByEmail($email);
        
        if ($existingUser) {
            // Update existing user with Firebase UID if needed
            if (empty($existingUser['firebase_uid'])) {
                $this->UserModel->updateFirebaseUid($existingUser['id'], $firebaseUid);
            }
            $userId = $existingUser['id'];
        } else {
            // Create new user
            $userData = [
                'username' => $name,
                'email' => $email,
                'firebase_uid' => $firebaseUid,
                'role' => 'youcoder'
            ];
            $userId = $this->UserModel->createSocialUser($userData);
        }

        // Set session variables
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = 'youcoder';
        $_SESSION['username'] = $name;

        // Send success response
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;

    } catch (Exception $e) {
        // Log error
        error_log('Social login error: ' . $e->getMessage());
        
        // Send error response
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

   public function logout() {
         if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
             unset($_SESSION['user_id']);
             unset($_SESSION['user_role']);
             session_destroy();
            
             header("Location: /home");
             exit;
         }
   }



}