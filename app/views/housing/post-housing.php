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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formSteps = [
                { id: 'location-step', title: 'Location', progress: '33%' },
                { id: 'details-step', title: 'Details', progress: '66%' },
                { id: 'photos-step', title: 'Photos', progress: '100%' }
            ];
            
            let currentStep = 0;

            const progressBar = document.querySelector('[data-progress-bar]');
            const stepIndicators = document.querySelectorAll('[data-step-indicator]');
            const nextButton = document.querySelector('[data-next-btn]');
            const backButton = document.querySelector('[data-back-btn]');
            const formSections = document.querySelectorAll('[data-form-step]');

            showStep(currentStep);

            nextButton.addEventListener('click', function() {
                if (validateCurrentStep()) {
                    if (currentStep < formSteps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    } else {
                        document.querySelector('form').submit();
                    }
                }
            });

            backButton.addEventListener('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            function showStep(stepIndex) {
                progressBar.style.width = formSteps[stepIndex].progress;

                stepIndicators.forEach((indicator, index) => {
                    if (index === stepIndex) {
                        indicator.classList.add('bg-accent-light');
                        indicator.classList.remove('bg-gray-200');
                    } else if (index < stepIndex) {
                        indicator.classList.add('bg-accent-light');
                        indicator.classList.remove('bg-gray-200');
                    } else {
                        indicator.classList.add('bg-gray-200');
                        indicator.classList.remove('bg-accent-light');
                    }
                });

                formSections.forEach((section, index) => {
                    if (index === stepIndex) {
                        section.classList.remove('hidden');
                    } else {
                        section.classList.add('hidden');
                    }
                });

                if (stepIndex === formSteps.length - 1) {
                    nextButton.textContent = 'Submit';
                } else {
                    nextButton.innerHTML = `Next Step <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>`;
                }

                if (stepIndex === 0) {
                    backButton.classList.add('invisible');
                } else {
                    backButton.classList.remove('invisible');
                }
            }

            function validateCurrentStep() {
                const currentSection = formSections[currentStep];
                const requiredFields = currentSection.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('border-red-500');
                        field.classList.add('animate-shake');
                        setTimeout(() => {
                            field.classList.remove('animate-shake');
                        }, 500);
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                return isValid;
            }
        });
    </script>
    <title>Post Housing - RoomMate</title>
</head>
<body class="bg-gradient-to-br from-background to-accent-light/10">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-primary-dark/95 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <a href="/home" class="text-2xl font-bold text-white hover:text-accent-light transition-colors duration-300">
                    RoomMate
                </a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen pt-28 pb-16">
        <div class="max-w-3xl mx-auto px-4">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-primary-dark mb-3">Post Your Housing</h1>
                <p class="text-primary-medium/80 text-lg">Let's find your perfect roommate match</p>
            </div>

            <div class="flex justify-between items-center mb-12 relative">
                <div class="absolute left-0 top-1/2 h-0.5 w-full bg-gray-200 -z-10"></div>
                <div class="absolute left-0 top-1/2 h-0.5 w-1/3 bg-accent-light -z-10 transition-all duration-500" data-progress-bar></div>
                
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-accent-light flex items-center justify-center text-primary-dark font-semibold mb-2" data-step-indicator>1</div>
                    <span class="text-sm text-primary-medium">Location</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-primary-medium font-semibold mb-2" data-step-indicator>2</div>
                    <span class="text-sm text-primary-medium">Details</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-primary-medium font-semibold mb-2" data-step-indicator>3</div>
                    <span class="text-sm text-primary-medium">Photos</span>
                </div>
            </div>

            <form action="/housing/store" method="POST" enctype="multipart/form-data">
                <div data-form-step>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="p-3 bg-accent-light/10 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-primary-dark">Location Details</h2>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-primary-medium/80 mb-2">Street Address</label>
                                    <input type="text" name="address" required 
                                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300"
                                        placeholder="Enter your street address">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-primary-medium/80 mb-2">City</label>
                                        <input type="text" name="city" required 
                                            class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300"
                                            placeholder="Enter city">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-primary-medium/80 mb-2">Neighborhood</label>
                                        <input type="text" name="neighborhood" required 
                                            class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300"
                                            placeholder="Enter neighborhood">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-form-step class="hidden">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="p-3 bg-accent-light/10 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-primary-dark">Housing Details</h2>
                            </div>

                            <div class="space-y-6">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-primary-medium/80 mb-2">Monthly Rent</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">MAD</span>
                                            <input type="number" name="rent" required 
                                                class="w-full pl-14 pr-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300"
                                                placeholder="0.00">
                                        </div>
                                    </div>
                                    <div>
                                    <label class="block text-sm font-medium text-primary-medium/80 mb-2">Housing Capacity</label>
                                    <input type="number" name="capacity" required 
                                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300"
                                        placeholder="Number of people">
                                </div>
                                    
                                </div>

                            
                                

                                <div>
                                    <label class="block text-sm font-medium text-primary-medium/80 mb-2">Available From</label>
                                    <input type="date" name="availability_date" required 
                                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-primary-medium/80 mb-4">Available Amenities</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <label class="flex items-center space-x-3">
                                            <input type="checkbox" name="amenities[]" value="wifi" class="rounded text-accent-light focus:ring-accent-light">
                                            <span>WiFi</span>
                                        </label>
                                        <label class="flex items-center space-x-3">
                                            <input type="checkbox" name="amenities[]" value="washing_machine" class="rounded text-accent-light focus:ring-accent-light">
                                            <span>Washing Machine</span>
                                        </label>
                                        <label class="flex items-center space-x-3">
                                            <input type="checkbox" name="amenities[]" value="kitchen" class="rounded text-accent-light focus:ring-accent-light">
                                            <span>Kitchen</span>
                                        </label>
                                        <label class="flex items-center space-x-3">
                                            <input type="checkbox" name="amenities[]" value="parking" class="rounded text-accent-light focus:ring-accent-light">
                                            <span>Parking</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-primary-medium/80 mb-2">House Rules</label>
                                    <textarea name="rules" required rows="3" 
                                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-accent-light focus:ring focus:ring-accent-light/20 transition-all duration-300"
                                        placeholder="Describe your house rules separated by comma (,) ex : Interdiction de fumer, animaux, invités"></textarea>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>

                <div data-form-step class="hidden">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="p-3 bg-accent-light/10 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-primary-dark">Upload Photos</h2>
                            </div>

                            <div class="space-y-4">
                                <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center">
                                    <input type="file" name="photos[]" multiple accept="image/*" required
                                        class="hidden" id="photo-upload">
                                    <label for="photo-upload" class="cursor-pointer">
                                        <div class="space-y-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <div class="text-primary-medium">
                                                <span class="font-medium">Click to upload</span> or drag and drop
                                            </div>
                                            <p class="text-sm text-gray-500">Maximum 5 photos (PNG, JPG)</p>
                                        </div>
                                    </label>
                                </div>
                                <div id="preview" class="grid grid-cols-3 gap-4"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-10">
    <button type="button" data-back-btn class="invisible px-6 py-3 text-primary-medium hover:text-primary-dark transition-colors duration-300 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back
    </button>
    <button type="button" data-next-btn class="px-8 py-3 bg-primary-dark text-white rounded-xl hover:bg-primary-medium transition-all duration-300 flex items-center gap-2 group">
        Next Step
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
            </form>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</body>
</html>
