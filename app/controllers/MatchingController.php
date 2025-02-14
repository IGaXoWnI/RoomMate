<?php 
require_once (__DIR__.'/../models/User.php');

class MatchingController extends BaseController {
 
    private $UserModel ;
    private $HousingModel;
   public function __construct(){

      $this->UserModel = new User();
   }


   public function Match(){
    $anonces = $this->HousingModel->getAnoncesData($id);
    $user = $this->UserModel->getUserData($_SESSION['user_id']);
    $score = 0;

    if($user['budget'] - $anonces['loyer'] >= 0){
        $score += 30;
    }

    if($user['budget'] - $anonces['loyer'] >= 0){

    }


}}?>