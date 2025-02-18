<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - RoomMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 ">

    <nav class="sticky top-0 left-0 right-0 z-50 bg-black backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <a href="/home" class="text-2xl font-bold text-white hover:text-accent-light transition-colors duration-300">
                    RoomMate
                </a>
                <a href="/find-housing" class="text-white hover:text-accent-light transition-colors duration-300">
                    Back to Listings
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="flex h-[600px]">
                <!-- Liste des conversations -->
                <div class="w-1/3 border-r border-gray-200 bg-gray-50">
                    <div class="p-4 border-b border-gray-200 bg-white">
                        <h2 class="text-xl font-semibold text-gray-800">Messages</h2>
                    </div>
                    <div class="overflow-y-auto h-[calc(600px-64px)]">
                        <?php foreach ($conversations as $conv): ?>
                            <a href="/chat?user=<?= $conv['id'] ?>" 
                               class="block p-4 border-b border-gray-100 hover:bg-gray-100 transition-colors <?= isset($_GET['user']) && $_GET['user'] == $conv['id'] ? 'bg-white shadow-sm' : '' ?>">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                        <?php if ($conv['photo_profil']): ?>
                                            <img src="/uploads/<?= htmlspecialchars($conv['photo_profil']) ?>" 
                                                 alt="<?= htmlspecialchars($conv['username']) ?>" 
                                                 class="w-full h-full rounded-full object-cover">
                                        <?php else: ?>
                                            <span class="text-xl font-semibold text-gray-500">
                                                <?= strtoupper(substr($conv['username'], 0, 1)) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-gray-900 truncate">
                                            <?= htmlspecialchars($conv['username']) ?>
                                        </h3>
                                        <p class="text-sm text-gray-500 truncate">
                                            <?= htmlspecialchars($conv['dernier_message'] ?? 'Aucun message') ?>
                                        </p>
                                    </div>
                                    <?php if ($conv['derniere_date']): ?>
                                        <span class="text-xs text-gray-400">
                                            <?= (new DateTime($conv['derniere_date']))->format('H:i') ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Zone de chat -->
                <div class="flex-1 flex flex-col bg-gray-50">
                    <?php if (isset($_GET['user'])): ?>
                        <?php 
                        $chatUser = $this->userModel->getUserById($_GET['user']);
                        if ($chatUser):
                        ?>
                            <div class="p-4 border-b border-gray-200 bg-white shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <?php if ($chatUser['photo_profil']): ?>
                                            <img src="/uploads/<?= htmlspecialchars($chatUser['photo_profil']) ?>" 
                                                 alt="<?= htmlspecialchars($chatUser['username']) ?>" 
                                                 class="w-full h-full rounded-full object-cover">
                                        <?php else: ?>
                                            <span class="text-lg font-semibold text-gray-500">
                                                <?= strtoupper(substr($chatUser['username'], 0, 1)) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="font-medium text-gray-900">
                                        <?= htmlspecialchars($chatUser['username']) ?>
                                    </h3>
                                </div>
                            </div>

                            <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">
                                <?php 
                                $messages = $this->messageModel->getMessages($_SESSION['user_id'], $_GET['user']);
                                foreach ($messages as $message):
                                    $isOwn = $message['expediteur_id'] == $_SESSION['user_id'];
                                ?>
                                    <div class="flex <?= $isOwn ? 'justify-end' : 'justify-start' ?> mb-4">
                                        <div class="max-w-[70%] <?= $isOwn ? 'bg-blue-600 text-white' : 'bg-white shadow-sm' ?> rounded-2xl px-4 py-2">
                                            <p><?= htmlspecialchars($message['contenu']) ?></p>
                                            <p class="text-xs <?= $isOwn ? 'text-blue-100' : 'text-gray-500' ?> mt-1">
                                                <?= (new DateTime($message['date_envoi'] ?? ''))->format('H:i') ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <form action="/send-message" method="POST" class="p-4 border-t border-gray-200 bg-white">
                                <div class="flex gap-2">
                                    <input type="hidden" name="destinataire_id" value="<?= $_GET['user'] ?>">
                                    <input type="text" 
                                           name="contenu" 
                                           required
                                           placeholder="Écrivez votre message..." 
                                           class="flex-1 px-4 py-3 border border-gray-200 rounded-full focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                                    <button type="submit" 
                                            class="px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Envoyer
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="flex-1 flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p>Sélectionnez une conversation pour commencer à chatter</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 