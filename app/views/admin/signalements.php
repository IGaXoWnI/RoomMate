<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
    <div class="flex items-start">

      <?php include __DIR__ . "/../partials/sidebar.php" ?>

      <button id="toggle-sidebar"
        class='lg:hidden w-8 h-8 z-[100] fixed top-[36px] left-[10px] cursor-pointer bg-[#007bff] flex items-center justify-center rounded-full outline-none transition-all duration-500'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" class="w-3 h-3" viewBox="0 0 55.752 55.752">
          <path
            d="M43.006 23.916a5.36 5.36 0 0 0-.912-.727L20.485 1.581a5.4 5.4 0 0 0-7.637 7.638l18.611 18.609-18.705 18.707a5.398 5.398 0 1 0 7.634 7.635l21.706-21.703a5.35 5.35 0 0 0 .912-.727 5.373 5.373 0 0 0 1.574-3.912 5.363 5.363 0 0 0-1.574-3.912z"
            data-original="#000000" />
        </svg>
      </button>

      <section class="main-content w-full px-8">

      <header class='z-50 bg-[#f7f6f9] sticky top-0 pt-8'>
          <div class='flex flex-wrap items-center w-full relative tracking-wide'>
            <div class='flex items-center gap-y-6 max-sm:flex-col z-50 w-full pb-2'>
              <div
                class='flex items-center gap-4 w-full px-6 bg-white shadow-sm min-h-[48px] sm:mr-20 rounded-md outline-none border-none'>
                <input type='text' placeholder='Search something...'
                  class='w-full text-sm bg-transparent rounded outline-none' />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904"
                  class="w-4 cursor-pointer fill-gray-400 ml-auto">
                  <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                  </path>
                </svg>
              </div>
  
              <div class="flex items-center just1ify-end gap-6 ml-auto">
                <div class="w-1 h-10 border-l border-gray-400">
                </div>
                <div class="dropdown-menu relative flex shrink-0 group">
                  <div class="flex items-center gap-4">
                    <p class="text-gray-500 text-sm">Hi, John Doe</p>
                    <img src="https://readymadeui.com/team-1.webp" alt="profile-pic"
                      class="w-[38px] h-[38px] rounded-full border-2 border-gray-300 cursor-pointer" />
                  </div>
  
                  <div
                    class="dropdown-content hidden group-hover:block shadow-md p-2 bg-white rounded-md absolute top-[38px] right-0 w-56">
                    <div class="w-full space-y-2">
                      <a href="javascript:void(0)"
                        class="text-sm text-gray-800 cursor-pointer flex items-center p-2 rounded-md hover:bg-[#ffece1] dropdown-item transition duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] mr-4 fill-current"
                          viewBox="0 0 512 512">
                          <path
                            d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703zM256 269.507c-42.871 0-77.754-34.882-77.754-77.753C178.246 148.879 213.13 114 256 114s77.754 34.879 77.754 77.754c0 42.871-34.883 77.754-77.754 77.754zm170.719 134.427a175.9 175.9 0 0 0-46.352-82.004c-18.437-18.438-40.25-32.27-64.039-40.938 28.598-19.394 47.426-52.16 47.426-89.238C363.754 132.34 315.414 84 256 84s-107.754 48.34-107.754 107.754c0 37.098 18.844 69.875 47.465 89.266-21.887 7.976-42.14 20.308-59.566 36.542-25.235 23.5-42.758 53.465-50.883 86.348C50.852 364.242 30 312.512 30 256 30 131.383 131.383 30 256 30s226 101.383 226 226c0 56.523-20.86 108.266-55.281 147.934zm0 0"
                            data-original="#000000"></path>
                        </svg>
                        Account</a>
                      <hr class="my-2 -mx-2" />
  
                      
                                     
                        <form action="/logout" method="post">
                            <button type="submit" name="logout"
                              class="text-sm text-gray-800 w-full cursor-pointer flex items-center p-2 rounded-md hover:bg-[#ffece1] dropdown-item transition duration-300 ease-in-out">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] mr-4 fill-current"
                                viewBox="0 0 6 6">
                                <path
                                  d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                                  data-original="#000000" />
                              </svg>
                              Logout</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>


        <section class="main-content w-full px-8">
    <!-- Stats Cards avec un style différent -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 mt-8">
        <div class="bg-gradient-to-r from-[#213555] to-[#3E5879] p-6 rounded-xl text-white shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-white/10 backdrop-blur-sm rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-white/80">Total Signalements</p>
                    <p class="text-2xl font-bold"><?= $totalSignalements ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-400">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-yellow-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#3E5879]">En Attente</p>
                    <p class="text-2xl font-bold text-[#213555]"><?= $enAttente ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-400">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#3E5879]">Traités</p>
                    <p class="text-2xl font-bold text-[#213555]"><?= $traites ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-400">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#3E5879]">Rejetés</p>
                    <p class="text-2xl font-bold text-[#213555]"><?= $rejetes ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres avec un nouveau design -->
    <div class="mb-6 bg-white p-4 rounded-xl shadow-sm">
        <div class="flex flex-wrap gap-4">
            <button class="px-6 py-2 rounded-full bg-[#213555] text-white hover:bg-[#3E5879] transition-all">
                Tous
            </button>
            <button class="px-6 py-2 rounded-full border-2 border-[#213555] text-[#213555] hover:bg-[#F5EFE7] transition-all">
                En attente
            </button>
            <button class="px-6 py-2 rounded-full border-2 border-[#213555] text-[#213555] hover:bg-[#F5EFE7] transition-all">
                Traités
            </button>
            <button class="px-6 py-2 rounded-full border-2 border-[#213555] text-[#213555] hover:bg-[#F5EFE7] transition-all">
                Rejetés
            </button>
        </div>
    </div>

    <!-- Liste des signalements avec un nouveau design -->
    <div class="grid grid-cols-1 gap-6">
        <?php foreach($signalements as $signalement): ?>
            <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#213555] flex items-center justify-center text-white font-bold text-lg">
                                <?= strtoupper(substr($signalement['signaleur_username'], 0, 2)) ?>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#213555]">
                                    <?= htmlspecialchars($signalement['signaleur_username']) ?>
                                </h3>
                                <p class="text-sm text-[#3E5879]">
                                    a signalé l'annonce de <?= htmlspecialchars($signalement['annonceur_username']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-1.5 rounded-full text-sm font-medium
                                <?php
                                    switch($signalement['statut']) {
                                        case 'En attente':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'Traité':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'Rejeté':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                    }
                                ?>">
                                <?= $signalement['statut'] ?>
                            </span>
                            <span class="px-4 py-1.5 rounded-full text-sm font-medium
                                <?php
                                    switch($signalement['annonce_statut']) {
                                        case 'active':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'inactif':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'rejete':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                    }
                                ?>">
                                Annonce <?= $signalement['annonce_statut'] ?>
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-[#F5EFE7]/50 p-4 rounded-xl">
                            <h4 class="text-sm font-semibold text-[#213555] mb-3">Détails de l'annonce</h4>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs text-[#3E5879] mb-1">Localisation</p>
                                    <p class="text-sm font-medium text-[#213555]">
                                        <?= htmlspecialchars($signalement['localisation']) ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-[#3E5879] mb-1">Loyer</p>
                                    <p class="text-sm font-medium text-[#213555]">
                                        <?= number_format($signalement['loyer'], 2) ?> DH
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-[#3E5879] mb-1">Capacité</p>
                                    <p class="text-sm font-medium text-[#213555]">
                                        <?= $signalement['capacite'] ?> personnes
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-red-50 p-4 rounded-xl">
                            <h4 class="text-sm font-semibold text-red-800 mb-3">Raison du signalement</h4>
                            <p class="text-sm text-red-600">
                                <?= nl2br(htmlspecialchars($signalement['raison'])) ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-[#F5EFE7]">
                        <form action="/admin/update-signalement" method="POST" class="flex-1 mr-4">
                            <input type="hidden" name="signalement_id" value="<?= $signalement['id'] ?>">
                            <select name="statut" 
                                    class="w-full text-sm px-4 py-2 rounded-lg border-2 border-[#D8C4B6] bg-white text-[#213555] focus:outline-none focus:border-[#3E5879] cursor-pointer hover:bg-[#F5EFE7] transition-all"
                                    onchange="this.form.submit()">
                                <option value="En attente" <?= $signalement['statut'] === 'En attente' ? 'selected' : '' ?>>
                                    En attente
                                </option>
                                <option value="Traité" <?= $signalement['statut'] === 'Traité' ? 'selected' : '' ?>>
                                    Traité
                                </option>
                                <option value="Rejeté" <?= $signalement['statut'] === 'Rejeté' ? 'selected' : '' ?>>
                                    Rejeté
                                </option>
                            </select>
                        </form>
                        <a href="/dashboard/annonce?id=<?= $signalement['annonce_id'] ?>" 
                           class="px-6 py-2 bg-[#213555] text-white rounded-lg hover:bg-[#3E5879] transition-all inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Voir l'annonce
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

</body>

</html>