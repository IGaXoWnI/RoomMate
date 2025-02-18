<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomMate - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F5EFE7] font-sans m-0 p-0 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-[#213555] text-center text-2xl font-bold mb-8">Créer un compte</h2>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $_SESSION['success'] ?></span>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST" id="registerForm">
            <div class="mb-6">
                <label for="username" class="block text-[#3E5879] mb-2 font-bold">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required 
                    class="w-full p-3 border border-[#D8C4B6] rounded focus:outline-none focus:border-[#213555]">
            </div>

            <div class="mb-6">
                <label for="email" class="block text-[#3E5879] mb-2 font-bold">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full p-3 border border-[#D8C4B6] rounded focus:outline-none focus:border-[#213555]">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-[#3E5879] mb-2 font-bold">Mot de passe</label>
                <input type="password" id="password" name="password" required 
                    class="w-full p-3 border border-[#D8C4B6] rounded focus:outline-none focus:border-[#213555]">
            </div>

            <div class="mb-6">
                <label for="annee_etudes" class="block text-[#3E5879] mb-2 font-bold">Année d'études</label>
                <select id="annee_etudes" name="annee_etudes" required 
                    class="w-full p-3 border border-[#D8C4B6] rounded focus:outline-none focus:border-[#213555]">
                    <option value="">Sélectionner une année</option>
                    <option value="1">1ère année</option>
                    <option value="2">2ème année</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="role" class="block text-[#3E5879] mb-2 font-bold">Rôle</label>
                <select id="role" name="role" required 
                    class="w-full p-3 border border-[#D8C4B6] rounded focus:outline-none focus:border-[#213555]">
                    <option value="">Sélectionner un rôle</option>
                    <option value="admin">Admin</option>
                    <option value="youcoder">YouCoder</option>
                </select>
            </div>

            <button name='signup' type="submit" 
                class="w-full py-4 bg-[#213555] text-white rounded hover:bg-[#3E5879] transition-colors duration-300 text-base cursor-pointer">
                S'inscrire
            </button>
        </form>
        <div class="text-center mt-4 text-[#3E5879]">
            Déjà inscrit? <a href="/login" class="text-[#213555] font-bold no-underline">Se connecter</a>
        </div>
    </div>
</body>
</html> 