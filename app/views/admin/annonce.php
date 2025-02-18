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
                            d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 53.687 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703zM256 269.507c-42.871 0-77.754-34.882-77.754-77.753C178.246 148.879 213.13 114 256 114s77.754 34.879 77.754 77.754c0 42.871-34.883 77.754-77.754 77.754zm170.719 134.427a175.9 175.9 0 0 0-46.352-82.004c-18.437-18.438-40.25-32.27-64.039-40.938 28.598-19.394 47.426-52.16 47.426-89.238C363.754 132.34 315.414 84 256 84s-107.754 48.34-107.754 107.754c0 37.098 18.844 69.875 47.465 89.266-21.887 7.976-42.14 20.308-59.566 36.542-25.235 23.5-42.758 53.465-50.883 86.348C50.852 364.242 30 312.512 30 256 30 131.383 131.383 30 256 30s226 101.383 226 226c0 56.523-20.86 108.266-55.281 147.934zm0 0"
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

        <!--------------------------------------------- GESTION DES Annonces ---------------------------------------------------------->

        <section id="user" class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
          <!-- Header -->
          <div class="w-full max-w-7xl bg-white shadow-sm rounded-lg p-6 space-y-6">
            <div class="flex justify-between items-center">
              <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                Gestion des Annonces
              </h1>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg border border-[#D8C4B6]/20">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-[#F5EFE7] rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#213555]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-[#3E5879]">Total Annonces</p>
                            <p class="text-2xl font-semibold text-[#213555]"><?= $totalAnnonces ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg border border-[#D8C4B6]/20">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-[#F5EFE7] rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#213555]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-[#3E5879]">Active Annonces</p>
                            <p class="text-2xl font-semibold text-[#213555]"><?= $activeAnnonces ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg border border-[#D8C4B6]/20">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-[#F5EFE7] rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#213555]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-[#3E5879]">Pending Annonces</p>
                            <p class="text-2xl font-semibold text-[#213555]"><?= $pendingAnnonces ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-lg border border-[#D8C4B6]/20">
                <div class="p-6 border-b border-[#F5EFE7]">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-[#213555]">Liste des Annonces</h2>
                            <p class="text-sm text-[#3E5879] mt-1">Gérez vos Annonces facilement</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left px-8 py-4 text-sm font-medium text-[#213555] bg-[#F5EFE7]">Utilisateur</th>
                                <th class="text-left px-8 py-4 text-sm font-medium text-[#213555] bg-[#F5EFE7]">Localisation</th>
                                <th class="text-left px-8 py-4 text-sm font-medium text-[#213555] bg-[#F5EFE7]">Loyer</th>
                                <th class="text-left px-8 py-4 text-sm font-medium text-[#213555] bg-[#F5EFE7]">Capacite</th>
                                <th class="text-left px-8 py-4 text-sm font-medium text-[#213555] bg-[#F5EFE7]">Status</th>
                                <th class="text-left px-8 py-4 text-sm font-medium text-[#213555] bg-[#F5EFE7]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5EFE7]">
                            <?php foreach($annonces as $annonce): ?>
                                <tr class="hover:bg-[#F5EFE7]/30 transition-colors">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-[#213555] flex items-center justify-center text-white font-medium">
                                                <?= !empty($annonce['username']) ? strtoupper(substr($annonce['username'], 0, 2)) : 'U' ?>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-[#213555]">
                                                    <?= !empty($annonce['nom_complet']) ? htmlspecialchars($annonce['nom_complet']) : 'Non défini' ?>
                                                </p>
                                                <p class="text-xs text-[#3E5879]">
                                                    @<?= !empty($annonce['username']) ? htmlspecialchars($annonce['username']) : 'utilisateur' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4">
                                        <p class="text-sm text-[#213555]">
                                            <?= !empty($annonce['localisation']) ? htmlspecialchars($annonce['localisation']) : 'Non défini' ?>
                                        </p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <p class="text-sm text-[#213555]">
                                            <?= !empty($annonce['loyer']) ? htmlspecialchars($annonce['loyer']) : 'Non défini' ?>
                                        </p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <p class="text-sm text-[#213555]">
                                            <?= !empty($annonce['capacite']) ? htmlspecialchars($annonce['capacite']) : 'Non défini' ?>
                                        </p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-2">
                                            <form action="/dashboard/update-annonce" method="POST" class="role-form">
                                                <input type="hidden" name="annonce_id" value="<?= $annonce['id'] ?>">
                                                <select name="statut" 
                                                        class="w-32 text-sm px-3 py-1.5 rounded-md border border-[#D8C4B6] bg-white text-[#213555] focus:outline-none focus:border-[#3E5879] cursor-pointer hover:bg-[#F5EFE7] transition-all"
                                                        onchange="this.form.submit()">
                                                    <option value="inactif" <?= (!empty($annonce['statut']) && $annonce['statut'] === 'inactif') ? 'selected' : '' ?>>
                                                        inactif
                                                    </option>
                                                    <option value="active" <?= (!empty($annonce['statut']) && $annonce['statut'] === 'active') ? 'selected' : '' ?>>
                                                        active
                                                    </option>
                                                    <option value="rejete" <?= (!empty($annonce['statut']) && $annonce['statut'] === 'rejete') ? 'selected' : '' ?>>
                                                        rejete
                                                    </option>
                                                    <option value="bloquer" <?= (!empty($annonce['statut']) && $annonce['statut'] === 'bloquer') ? 'selected' : '' ?>>
                                                        bloquer
                                                    </option>
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                      <form action="/dashboard/delete-annonce" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                        <input type="hidden" name="annonce_id" value="<?= $annonce['id'] ?>">

                                        <button name="delete"
                                                      class="p-2 hover:bg-red-50 rounded-md transition-colors">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                  </svg>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
  
</section>
</div>
</div>


<script defer>
  document.addEventListener('DOMContentLoaded', () => {
    
    let sidebarToggleBtn = document.getElementById('toggle-sidebar');
    let sidebarCollapseMenu = document.getElementById('sidebar-collapse-menu');

    sidebarToggleBtn.addEventListener('click', () => {
      if (!sidebarCollapseMenu.classList.contains('open')) {
          sidebarCollapseMenu.classList.add('open');
          sidebarCollapseMenu.style.cssText = 'width: 250px; visibility: visible; opacity: 1;';
          sidebarToggleBtn.style.cssText = 'left: 236px;';
      } else {
          sidebarCollapseMenu.classList.remove('open');
          sidebarCollapseMenu.style.cssText = 'width: 32px; visibility: hidden; opacity: 0;';
          sidebarToggleBtn.style.cssText = 'left: 10px;';
      }

    });
  });
</script>

</body>

</html>