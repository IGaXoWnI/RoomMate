<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile YouCoder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#213555',
                        'primary-medium': '#3E5879',
                        'accent-light': '#D8C4B6',
                        'background': '#F5EFE7',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-background">
    <?php include __DIR__ .'/../partials/header.php'?>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-24 bg-primary-dark "></div>
            
            <div class="relative px-6 py-8">
                <div class="absolute -top-16 left-6">
                    <img src="<?php echo $user['photo_profil']===null ? '/assets/images/User-Profile.png' :$user['photo_profil'] ?>" 
                         class="w-32 h-32 rounded-full border-4 border-white object-cover"
                         alt="Profile Picture">
                </div>
                
                <button onclick="openModal()" 
                        class="absolute top-4 right-6 bg-primary-medium hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition">
                    Modifier le profil
                </button>

                <div class="mt-16">
                    <h1 class="text-3xl font-bold text-primary-dark"><?=$user['nom_complet'] ?? $user['username']?></h1>
                    <p class="text-primary-medium">@<?=$user['username'] ?? 'username'?></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="space-y-4">
                        <div class="bg-accent-light/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-primary-dark">Email</h3>
                            <p><?=$user['email'] ?? 'email'?></p>
                        </div>
                        <div class="bg-accent-light/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-primary-dark">Ville actuelle</h3>
                            <p><?=$user['ville_actuelle'] ?? 'Ex: Nador'?></p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-accent-light/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-primary-dark">Estimate Budget</h3>
                            <p><?=$user['budget'].'MAD' ?? '0.00 MAD'?></p>
                        </div>
                        <div class="bg-accent-light/20 p-4 rounded-lg">
                            <h3 class="font-semibold text-primary-dark">Ville d'origine</h3>
                            <p><?=$user['ville_origine'] ?? 'Ex: Nador'?></p>
                        </div>
                    </div>
                </div>

           
                <div class="mt-6">
                    <h3 class="font-semibold text-primary-dark mb-2">Biographie</h3>
                    <p class="bg-accent-light/20 p-4 rounded-lg"><?=$user['biographie'] ?? 'Describe Your Self...'?></p>
                </div>

         
                <div class="mt-6">
                    <h3 class="font-semibold text-primary-dark mb-2">Préférences</h3>
                    <p class="bg-accent-light/20 p-4 rounded-lg"><?=$user['preferences'] ?? 'Describe Your Ideal RoomMate...'?></p>
                </div>
            </div>
        </div>
    </div>

 
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg w-full max-w-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Modifier le profil</h2>
                    <form action="/update-profile" method="POST" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Photo de profil</label>
                                <input type="file" name="image" class="mt-1 w-full">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Nom complet</label>
                                <input type="text" name="nom_complet" value="<?=$user['nom_complet'] ?? 'Votre Nom'?>" 
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Email</label>
                                <input type="email" name="email" value="<?=$user['email'] ?? 'Email'?>" 
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Estimate Budget</label>
                                <input type="number" name="budget" value="<?=$user['budget'] ?? '0.00 MAD'?>" 
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Ville d'origine</label>
                                <input type="text" name="ville_origine" value="<?=$user['ville_origine'] ?? 'ville origine'?>" 
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Ville actuelle</label>
                                <input type="text" name="ville_actuelle" value="<?=$user['ville_actuelle'] ?? 'ville actuelle'?>" 
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark">Année d'études</label>
                                <select id="annee_etudes" name="annee_etudes" value="" required 
                                    class="w-full p-3 border border-[#D8C4B6] rounded focus:outline-none focus:border-[#213555]">
                                    <option value="<?=$user['annee_etudes'] ?? 'année etudes'?>"><?=$user['annee_etudes'].'année' ?? 'année etudes'?></option>
                                    <option value="1er année">1ère année</option>
                                    <option value="2eme année">2ème année</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-primary-dark">Biographie</label>
                                <textarea name="biographie" rows="3" 
                                          class="mt-1 w-full rounded-md border-gray-300 shadow-sm"><?=$user['biographie'] ?? 'Bio'?></textarea>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-primary-dark">Préférences</label>
                                <textarea name="preferences" rows="3" 
                                          class="mt-1 w-full rounded-md border-gray-300 shadow-sm"><?=$user['preferences'] ?? 'preferences'?></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeModal()" 
                                    class="px-4 py-2 border border-primary-medium text-primary-medium rounded-lg hover:bg-primary-medium hover:text-white transition">
                                Annuler
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-primary-medium text-white rounded-lg hover:bg-primary-dark transition">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>