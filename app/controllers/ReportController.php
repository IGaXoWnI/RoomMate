<?php
require_once (__DIR__.'/../models/Report.php');


class ReportController {
    private $reportModel;

    public function __construct() {
        $this->reportModel = new Report();
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour signaler une annonce';
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /home');
            exit;
        }

        $annonceId = $_POST['annonce_id'] ?? null;
        $motif = $_POST['motif'] ?? '';
        $description = $_POST['description'] ?? '';

        if (!$annonceId || !$motif || !$description) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires';
            header('Location: /housing/' . $annonceId);
            exit;
        }

        $data = [
            'annonce_id' => $annonceId,
            'utilisateur_id' => $_SESSION['user_id'],
            'raison' => $motif . ': ' . $description
        ];

        if ($this->reportModel->create($data)) {
            $_SESSION['success'] = 'Votre signalement a été envoyé avec succès';
        } else {
            $_SESSION['error'] = 'Une erreur est survenue lors de l\'envoi du signalement';
        }

        header('Location: /housing/details/' . $annonceId);
        exit;
    }

    public function index() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: /home');
            exit;
        }

        $reports = $this->reportModel->getAllReports();
        require 'app/views/admin/reports.php';
    }

    public function updateStatus() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: /home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/reports');
            exit;
        }

        $reportId = $_POST['report_id'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$reportId || !$status) {
            $_SESSION['error'] = 'Données invalides';
            header('Location: /admin/reports');
            exit;
        }

        if ($this->reportModel->updateStatus($reportId, $status)) {
            $_SESSION['success'] = 'Statut mis à jour avec succès';
        } else {
            $_SESSION['error'] = 'Erreur lors de la mise à jour du statut';
        }

        header('Location: /admin/reports');
        exit;
    }
} 