<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>RoomMate YouCode</title>
</head>
<body class="bg-background">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-bold text-white">RoomMate</h1>
                </div>
                
                <!-- Right Navigation -->
                 <?php if(isset($_SESSION['user_id'])): ?>
                <div class="flex items-center space-x-4">
                    <a href="/profile" class="text-white hover:text-accent-light px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                        Profile
                    </a>    
                    <a href="/logout" class="text-white hover:text-accent-light px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                        Logout
                    </a>    
                        </div>
                <?php else: ?>
                    <div class="flex items-center space-x-4">
                    <a href="/login" class="text-white hover:text-accent-light px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                        Login
                    </a>
                    <a href="/register" class="border-2 border-white text-white hover:bg-white hover:text-primary-dark px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                        Get Started
                    </a>
                        </div>
                <?php endif; ?> 
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="/assets/images/rommmate.jpg" alt="Roommate" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/80 to-primary-dark/60"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-background leading-tight mb-6">
                    Looking for a <span class="text-accent-light">roommate?</span>
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8">
                    Find your perfect roommate match among YouCode students. Share more than just a space - share your journey.
                </p>
                <div class="flex space-x-4">
                    <a href="/register" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-background bg-primary-dark hover:bg-primary-medium transition duration-150 ease-in-out">
                        Start Exploring
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="/about" class="inline-flex items-center px-6 py-3 border-2 border-accent-light text-base font-medium rounded-lg text-accent-light hover:bg-accent-light hover:text-primary-dark transition duration-150 ease-in-out">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcement Types Section -->
    <section class="h-[85vh] bg-background flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary-dark mb-4">
                    Post Your Announcement
                </h2>
                <p class="text-lg text-primary-medium">
                    Choose the type of announcement that matches your situation
                </p>
            </div>

            <!-- Announcement Types Cards -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- "I Have Housing" Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-primary-dark/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-primary-dark ml-4">I Have Housing</h3>
                        </div>
                        <ul class="space-y-3 text-primary-medium mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Precise location
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Financial details (rent & split)
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Housing capacity
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Available amenities
                            </li>
                        </ul>
                        <a href="/post-housing" class="group inline-flex items-center justify-center w-full px-6 py-4 text-base font-medium text-white bg-primary-dark rounded-xl hover:bg-primary-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                            Post Housing
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- "Looking for Housing" Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-primary-dark/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-primary-dark ml-4">Looking for Housing</h3>
                        </div>
                        <ul class="space-y-3 text-primary-medium mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Preferred locations
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Available budget
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Move-in date
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                </svg>
                                Search type (join/search together)
                            </li>
                        </ul>
                        <a href="/register" class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-white bg-primary-dark rounded-lg hover:bg-primary-medium transition duration-150 ease-in-out">
                            Find Housing
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
