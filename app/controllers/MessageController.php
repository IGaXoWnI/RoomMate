<?php
require_once __DIR__ . '/../models/Message.php';

class MessageController extends BaseController{
    protected $messageModel;
    protected $userModel;

    public function __construct() {
        $this->messageModel = new Message();
        $this->userModel = new User();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $conversations = $this->messageModel->getConversations($_SESSION['user_id']);
        
        // Si on vient d'une annonce, récupérer l'utilisateur cible
        $targetUser = null;
        if (isset($_GET['user'])) {
            $targetUser = $this->userModel->getUserById($_GET['user']);
        }

        $data = [
            "conversations" => $conversations
        ];

        $this->render("chat/index" , $data);
    }

    public function getMessages($params) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $messages = $this->messageModel->getMessages($_SESSION['user_id'], $params['id']);
        require 'app/views/chat/_messages.php';
    }

    public function sendMessage() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /chat');
            exit;
        }

        $destinataireId = $_POST['destinataire_id'] ?? null;
        $contenu = trim($_POST['contenu'] ?? '');

        if (!$destinataireId || !$contenu) {
            $_SESSION['error'] = 'Message invalide';
            header('Location: /chat');
            exit;
        }

        if ($this->messageModel->saveMessage($_SESSION['user_id'], $destinataireId, $contenu)) {
            header('Location: /chat?user=' . $destinataireId);
        } else {
            $_SESSION['error'] = 'Erreur lors de l\'envoi du message';
            header('Location: /chat');
        }
        exit;
    }
} 