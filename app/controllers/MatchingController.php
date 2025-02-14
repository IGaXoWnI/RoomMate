<?php 
require_once (__DIR__.'/../models/User.php');

class MatchingController extends BaseController {
 
    private $UserModel ;
    private $HousingModel;
   public function __construct(){

      $this->UserModel = new User();
      $this->HousingModel = new Housing();
   }


   public function Match(){
    $annonce = $this->HousingModel->getAnoncesData(1);
    $user = $this->UserModel->getUserData($_SESSION['user_id']);


    if (!isset($user['budget']) || !isset($user['ville_actuelle']) || !isset($user['preferences']) || empty($user['budget']) || empty($user['ville_actuelle']) || empty($user['preferences'])) {
        $_SESSION['unmatch'] = "Veuillez mettre à jour vos informations de profil pour calculer votre taux de matching.";
        die($_SESSION['unmatch']);
    }

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
    }

    die($_SESSION['match']);

}}?>