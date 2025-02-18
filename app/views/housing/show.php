<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <title>Housing Details - RoomMate</title>
</head>
<body class="bg-gradient-to-br from-background to-accent-light/10 min-h-screen">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-primary-dark/95 backdrop-blur-sm">
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

    <div class="pt-28 pb-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex gap-8">
                <div class="w-[60%]">
                    <?php 
                    $photos = !empty($listing['galerie_photos']) ? explode(',', $listing['galerie_photos']) : [];
                    ?>
                    
                    <div class="relative h-[500px] rounded-lg overflow-hidden group">
                        <?php if (!empty($photos)): ?>
                            <div id="mainImage" class="w-full h-full">
                                <img src="/uploads/<?= htmlspecialchars($photos[0]) ?>" 
                                     alt="Property view" 
                                     class="w-full h-full object-cover">
                            </div>
                            
                            <button onclick="previousImage()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 rounded-full flex items-center justify-center text-primary-dark opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            
                            <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 rounded-full flex items-center justify-center text-primary-dark opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            <div class="absolute bottom-4 right-4 px-3 py-1 bg-black/50 rounded-full text-white text-sm backdrop-blur-sm">
                                <span id="currentImageIndex">1</span>/<span><?= count($photos) ?></span>
                            </div>
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex gap-2 mt-4 overflow-x-auto pb-2">
                        <?php foreach ($photos as $index => $photo): ?>
                            <button onclick="showImage(<?= $index ?>)" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden opacity-70 hover:opacity-100 transition-opacity duration-300">
                                <img src="/uploads/<?= htmlspecialchars($photo) ?>" 
                                     alt="Thumbnail" 
                                     class="w-full h-full object-cover">
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="w-[40%] space-y-3">
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-6">
                        
                        <?php if(isset($_SESSION['match'])): ?>
                            <?php 
                            $percentage = intval(preg_replace('/[^0-9]/', '', $_SESSION['match']));
                            
                            $borderColor = $percentage <= 30 ? 'border-red-500' : ($percentage <= 60 ? 'border-orange-500' : 'border-green-500');
                            $iconColor = $percentage <= 30 ? 'text-red-500' : ($percentage <= 60 ? 'text-orange-500' : 'text-green-500');
                            $textColor = $percentage <= 30 ? 'text-red-800' : ($percentage <= 60 ? 'text-orange-800' : 'text-green-800');
                            $subTextColor = $percentage <= 30 ? 'text-red-600' : ($percentage <= 60 ? 'text-orange-600' : 'text-green-600');
                            $icon = $percentage <= 30 ? 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' : 
                                   ($percentage <= 60 ? 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z' : 
                                   'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z');
                            ?>
                        <div class="fixed top-24 right-4 bg-white border-l-4 <?= $borderColor ?> rounded-lg shadow-lg p-4 mb-4 transform transition-all duration-300 animate-slide-in" role="alert">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 <?= $iconColor ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $icon ?>"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium <?= $textColor ?>"><?= $_SESSION['match'] ?></p>
                                    <p class="text-sm <?= $subTextColor ?>">
                                        <?php if($percentage <= 30): ?>
                                            Low compatibility - You might want to keep looking
                                        <?php elseif($percentage <= 60): ?>
                                            Moderate match - Worth considering
                                        <?php else: ?>
                                            Great match - You can now message each other!
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <button onclick="this.parentElement.parentElement.style.display='none'" class="ml-4 <?= $subTextColor ?> hover:<?= $textColor ?> transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php unset($_SESSION['match']); ?>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['unmatch'])): ?>
                        <div class="fixed top-24 right-4 bg-white border-l-4 border-red-500 rounded-lg shadow-lg p-4 mb-4 transform transition-all duration-300 animate-slide-in" role="alert">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-red-800"><?= $_SESSION['unmatch'] ?></p>
                                    <p class="text-sm text-red-600">You can try matching with other listings</p>
                                </div>
                                <button onclick="this.parentElement.parentElement.style.display='none'" class="ml-4 text-red-600 hover:text-red-800">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php unset($_SESSION['unmatch']); ?>
                        <?php endif; ?>
                            <div>
                                <h1 class="text-3xl font-bold text-primary-dark mb-2">
                                    <?= htmlspecialchars($listing['localisation'] ?? 'Location not specified') ?>
                                </h1>
                                <p class="text-2xl font-semibold text-primary-medium">
                                    MAD <?= number_format($listing['loyer'] ?? 0, 0) ?> <span class="text-primary-medium/60 text-lg">/month</span>
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <button class="px-4 py-2 bg-primary-dark text-white text-sm rounded-lg hover:bg-primary-medium transition-all duration-300">
                                    Share
                                </button>
                                <button onclick="openReportModal()" 
                                        class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-all duration-300 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    Signaler
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center gap-6 text-primary-medium/80">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span><?= htmlspecialchars($listing['capacite'] ?? '0') ?> People</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Available from <?= $listing['disponibilite'] ? date('M j, Y', strtotime($listing['disponibilite'])) : 'Not specified' ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($listing['equipements'])): ?>
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <h2 class="text-xl font-semibold text-primary-dark mb-6">Amenities</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <?php 
                            $amenities = explode(',', $listing['equipements']);
                            foreach ($amenities as $amenity): 
                                if (trim($amenity)): 
                            ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-accent-light/10 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-primary-medium"><?= htmlspecialchars(ucfirst(trim($amenity))) ?></span>
                                </div>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($listing['regles'])): ?>
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <h2 class="text-xl font-semibold text-primary-dark mb-6">House Rules</h2>
                        <p class="text-primary-medium/80 whitespace-pre-line">
                            <?= htmlspecialchars($listing['regles']) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8">
            <div class="flex items-start justify-between mb-8">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-primary-dark/10 rounded-full flex items-center justify-center">
                        <span class="text-primary-dark font-semibold text-2xl">
                            <?= strtoupper(substr($listing['owner_name'] ?? 'U', 0, 1)) ?>
                        </span>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-primary-dark mb-1">
                            <?= htmlspecialchars($listing['owner_name'] ?? 'Anonymous') ?>
                        </h3>
                        <p class="text-primary-medium/70 mb-2">
                            <?= htmlspecialchars($listing['owner_city'] ?? 'Location not specified') ?>
                        </p>
                        <div class="flex items-center gap-4 text-sm text-primary-medium/70">
                            <span class="flex items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Joined <?= date('F Y', strtotime($listing['created_at'] ?? 'now')) ?>
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <?= htmlspecialchars($listing['owner_email'] ?? 'Email not provided') ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                <button onclick="window.location.href='/chat?user=<?= $listing['utilisateur_id'] ?>'" 
                        class="px-6 py-3 bg-primary-dark text-white rounded-lg hover:bg-primary-medium transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Message Owner
                </button>
                    <button class="px-6 py-3 bg-accent-light/10 text-primary-dark rounded-lg hover:bg-accent-light/20 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Request Phone Number
                    </button>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-primary-dark mb-4">Location</h3>
                <div id="map" class="h-[300px] w-full rounded-lg border border-accent-light/10"></div>
            </div>

            <div class="p-4 bg-accent-light/5 rounded-lg border border-accent-light/10">
                <h4 class="text-primary-dark font-medium mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Safety Tips
                </h4>
                <ul class="grid grid-cols-2 gap-4 text-sm text-primary-medium/70">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Meet in a public place first
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Never send money before viewing
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Report suspicious behavior
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Trust your instincts
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="reportModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-semibold text-primary-dark mb-4">Signaler cette annonce</h3>
            
            <form action="/report" method="POST">
                <input type="hidden" name="annonce_id" value="<?= $listing['id'] ?>">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Motif du signalement</label>
                    <select name="motif" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-dark">
                        <option value="">Sélectionnez un motif</option>
                        <option value="Contenu inapproprié">Contenu inapproprié</option>
                        <option value="Arnaque">Arnaque potentielle</option>
                        <option value="Fausses informations">Fausses informations</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-dark"
                        rows="4"
                        placeholder="Décrivez le problème..."></textarea>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeReportModal()" 
                        class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                        Annuler
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-300">
                        Envoyer le signalement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const photos = <?= json_encode($photos) ?>;
        let currentIndex = 0;

        function showImage(index) {
            if (index < 0) index = photos.length - 1;
            if (index >= photos.length) index = 0;
            
            currentIndex = index;
            const mainImage = document.getElementById('mainImage');
            mainImage.innerHTML = `<img src="/uploads/${photos[index]}" alt="Property view" class="w-full h-full object-cover">`;
            document.getElementById('currentImageIndex').textContent = index + 1;
        }

        function nextImage() {
            showImage(currentIndex + 1);
        }

        function previousImage() {
            showImage(currentIndex - 1);
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') previousImage();
            if (e.key === 'ArrowRight') nextImage();
        });


        const map = L.map('map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        async function showLocationOnMap(location) {
            try {
                const [address, neighborhood, city] = location.split(',').map(item => item.trim());
                
                const searchQuery = `${address}, ${city}, Morocco`;
                
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&country=Morocco&city=${encodeURIComponent(city)}`);
                const data = await response.json();
                
                if (data && data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);
                    
                    map.setView([lat, lon], 16);
                    
                    L.marker([lat, lon])
                        .addTo(map)
                        .bindPopup(`
                            <strong>${address}</strong><br>
                            ${neighborhood}<br>
                            ${city}
                        `);
                } else {
                    const cityResponse = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(city)},Morocco`);
                    const cityData = await cityResponse.json();
                    
                    if (cityData && cityData.length > 0) {
                        const lat = parseFloat(cityData[0].lat);
                        const lon = parseFloat(cityData[0].lon);
                        
                        map.setView([lat, lon], 13);
                        
                        L.marker([lat, lon])
                            .addTo(map)
                            .bindPopup(`
                                <strong>${address}</strong><br>
                                ${neighborhood}<br>
                                ${city}
                            `);
                    }
                }
            } catch (error) {
                console.error('Error geocoding address:', error);
            }
        }

        showLocationOnMap("<?= htmlspecialchars($listing['localisation']) ?>");

        function openReportModal() {
            document.getElementById('reportModal').classList.remove('hidden');
            document.getElementById('reportModal').classList.add('flex');
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.add('hidden');
            document.getElementById('reportModal').classList.remove('flex');
        }
    </script>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }
    </style>
</body>
</html> 