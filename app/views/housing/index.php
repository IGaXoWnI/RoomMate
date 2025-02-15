<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#213555',
                        'primary-medium': '#3E5879',
                        'accent-light': '#D8C4B6',
                        'background': '#F5EFE7',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <title>Find Housing - RoomMate</title>
</head>
<body class="bg-gradient-to-br from-background to-accent-light/10 min-h-screen">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-primary-dark/95 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <a href="/home" class="text-2xl font-bold text-white hover:text-accent-light transition-colors duration-300">
                    RoomMate
                </a>
                <a href="/post-housing" class="px-6 py-2.5 bg-accent-light text-primary-dark rounded-full hover:bg-accent-light/90 transition-all duration-300 font-medium">
                    Post Housing
                </a>
            </div>
        </div>
    </nav>

    <div class="pt-28 pb-16 px-4 max-w-7xl mx-auto">
        <div class="flex gap-8">
            <div class="w-[30%]">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-28">
                    <h2 class="text-xl font-semibold text-primary-dark mb-6">Filters</h2>
                    
                    <form action="/find-housing" method="GET" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-primary-medium mb-2">Price Range</label>
                            <div class="flex gap-4 items-center">
                                <input type="number" name="min_price" placeholder="Min" 
                                    class="w-full px-4 py-2 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" placeholder="Max" 
                                    class="w-full px-4 py-2 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-primary-medium mb-2">Capacity</label>
                            <select name="capacity" class="w-full px-4 py-2 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20">
                                <option value="">Any</option>
                                <option value="1">1 Person</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4+">4+ People</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-primary-medium mb-2">Amenities</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="amenities[]" value="wifi" 
                                        class="rounded text-accent-light focus:ring-accent-light">
                                    <span class="text-primary-medium/80">WiFi</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="amenities[]" value="washing_machine" 
                                        class="rounded text-accent-light focus:ring-accent-light">
                                    <span class="text-primary-medium/80">Washing Machine</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="amenities[]" value="kitchen" 
                                        class="rounded text-accent-light focus:ring-accent-light">
                                    <span class="text-primary-medium/80">Kitchen</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="amenities[]" value="parking" 
                                        class="rounded text-accent-light focus:ring-accent-light">
                                    <span class="text-primary-medium/80">Parking</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-primary-medium mb-2">Available From</label>
                            <input type="date" name="availability" 
                                class="w-full px-4 py-2 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20">
                        </div>

                        <button type="submit" 
                            class="w-full px-6 py-3 bg-primary-dark text-white rounded-xl hover:bg-primary-medium transition-all duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Apply Filters
                        </button>
                    </form>
                </div>
            </div>

            <div class="w-[60%]">
                <div class="text-center mb-4">
                    <h1 class="text-4xl font-bold text-primary-dark mb-3">Find Your Perfect Home</h1>
                    <p class="text-primary-medium/80 text-lg">Discover amazing places to live with great roommates</p>
                </div>
                <div
                    class='flex items-center gap-4 w-full px-4 my-4 bg-white shadow-sm min-h-[48px] rounded-md outline-none border-none'>
                    <input id="searchAnnocne" type='text' placeholder='Search something...'
                    class='w-full text-sm bg-transparent rounded outline-none' />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904"
                    class="w-4 cursor-pointer fill-gray-400 ml-auto">
                    <path
                        d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                    </path>
                    </svg>
                </div>

         


                <div id="listingsList" class="space-y-8">
                    
                </div>



            </div>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>


    <script> 

        const searchAnnocne = document.getElementById("searchAnnocne");
        
        function displayAnnonce(listings){
            const listingsList = document.getElementById("listingsList");
            
            listingsList.innerHTML = listings.map(listing => `
                <a href="/housing/details/${listing.id}" class="block group">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 flex">
                        <div class="w-[40%] relative overflow-hidden">
                            ${listing.main_photo ? `
                                <img src="/uploads/${listing.main_photo}" alt="Housing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            ` : `
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            `}
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 bg-primary-dark/90 text-white rounded-full text-sm font-medium backdrop-blur-sm">
                                    MAD ${listing.loyer.toLocaleString()}/month
                                </span>
                            </div>
                        </div>
                        <div class="w-[60%] p-8 flex flex-col">
                            <div class="flex-1">
                                <h2 class="text-2xl font-semibold text-primary-dark mb-2">${listing.localisation || 'Location not specified'}</h2>
                                <div class="flex items-center gap-4 text-primary-medium/70">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        ${listing.capacite || '0'} People
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Available from ${listing.disponibilite ? new Date(listing.disponibilite).toLocaleDateString() : 'Not specified'}
                                    </span>
                                </div>
                            </div>
                            ${listing.equipements ? `
                                <div class="mb-6">
                                    <h3 class="text-sm font-medium text-primary-medium mb-2">Amenities</h3>
                                    <div class="flex flex-wrap gap-2">
                                        ${listing.equipements.split(',').map(amenity => `
                                            <span class="px-3 py-1 bg-accent-light/10 text-primary-medium rounded-full text-sm">
                                                ${amenity.trim()}
                                            </span>
                                        `).join('')}
                                    </div>
                                </div>
                            ` : ''}
                            <div class="border-t border-gray-100 pt-6 mt-6 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-primary-dark/10 rounded-full flex items-center justify-center">
                                        <span class="text-primary-dark font-medium text-lg">
                                            ${listing.owner_name ? listing.owner_name[0].toUpperCase() : 'U'}
                                        </span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-primary-dark">${listing.owner_name || 'Anonymous'}</h3>
                                        <p class="text-sm text-primary-medium/70">${listing.owner_email || 'No email provided'}</p>
                                    </div>
                                </div>
                                <span class="px-4 py-2 bg-primary-dark text-white text-sm rounded-lg group-hover:bg-primary-medium transition-all duration-300 whitespace-nowrap">
                                    View Details
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            `).join('');
            }   



        async function searchListning(query = ''){

            try {

                const response = await axios.get(`/api/listning?search=${query}`);
                displayAnnonce(response.data);
                console.log(response.data);

            }catch(erreur){
                console.log(erreur);
            }

        }

        searchListning();
        searchAnnocne.addEventListener("input" , (e)=> {
            searchListning(e.target.value);
        });
        
        

    </script>
</body>
</html> 