<?php 
require_once (__DIR__.'/../models/User.php');

class MatchingController extends BaseController {
 
    private $UserModel ;
   public function __construct(){

      $this->UserModel = new User();
   }


   public function Match(){

    $user = $this->UserModel->getUserData($_SESSION['user_id']);

    
   }


}?>