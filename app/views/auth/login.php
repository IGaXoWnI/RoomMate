<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RoomMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F5EFE7]">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-2xl font-bold text-center text-[#213555] mb-6">Login to RoomMate</h2>
            

            <?php if(isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $_SESSION['success'] ?></span>
                <?php unset($_SESSION['success']); ?>
            </div>
             <?php endif; ?>


            <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
                <?php unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <form action="/login" method="post">
                <div class="mb-4">
                    <label for="email" class="block text-[#213555] text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-3 py-2 border border-[#D8C4B6] rounded-md focus:outline-none focus:ring-1 focus:ring-[#3E5879] focus:border-[#3E5879] bg-[#F5EFE7]/50">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-[#213555] text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 border border-[#D8C4B6] rounded-md focus:outline-none focus:ring-1 focus:ring-[#3E5879] focus:border-[#3E5879] bg-[#F5EFE7]/50">
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                            class="h-4 w-4 text-[#3E5879] border-[#D8C4B6] focus:ring-[#3E5879]">
                        <label for="remember" class="ml-2 text-sm text-[#213555]">Remember me</label>
                    </div>
                    <a href="" class="text-sm text-[#3E5879] hover:text-[#213555]">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" name='login' 
                    class="w-full bg-[#213555] text-white font-bold py-2 px-4 rounded-md hover:bg-[#3E5879] focus:outline-none focus:ring-2 focus:ring-[#3E5879] focus:ring-opacity-50 transition-colors duration-200">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-[#213555]">
                    Don't have an account? 
                    <a href="/register" class="text-[#3E5879] hover:text-[#213555] font-semibold">
                        Register here
                    </a>
                </p>
            </div>

            <div class="flex flex-col gap-4 mt-6">
                <button onclick="signInWithGoogle()" class="flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                    </svg>
                    Continue with Google
                </button>
                
                <button onclick="signInWithGithub()" class="flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 50 50">
                        <path d="M17.791,46.836C18.502,46.53,19,45.823,19,45v-5.4c0-0.197,0.016-0.402,0.041-0.61C19.027,38.994,19.014,38.997,19,39 c0,0-3,0-3.6,0c-1.5,0-2.8-0.6-3.4-1.8c-0.7-1.3-1-3.5-2.8-4.7C8.9,32.3,9.1,32,9.7,32c0.6,0.1,1.9,0.9,2.7,2c0.9,1.1,1.8,2,3.4,2 c2.487,0,3.82-0.125,4.622-0.555C21.356,34.056,22.649,33,24,33v-0.025c-5.668-0.182-9.289-2.066-10.975-4.975 c-3.665,0.042-6.856,0.405-8.677,0.707c-0.058-0.327-0.108-0.656-0.151-0.987c1.797-0.296,4.843-0.647,8.345-0.714 c-0.112-0.276-0.209-0.559-0.291-0.849c-3.511-0.178-6.541-0.039-8.187,0.097c-0.02-0.332-0.047-0.663-0.051-0.999 c1.649-0.135,4.597-0.27,8.018-0.111c-0.079-0.5-0.13-1.011-0.13-1.543c0-1.7,0.6-3.5,1.7-5c-0.5-1.7-1.2-5.3,0.2-6.6 c2.7,0,4.6,1.3,5.5,2.1C21,13.4,22.9,13,25,13s4,0.4,5.6,1.1c0.9-0.8,2.8-2.1,5.5-2.1c1.5,1.4,0.7,5,0.2,6.6c1.1,1.5,1.7,3.2,1.6,5 c0,0.484-0.045,0.951-0.11,1.409c3.499-0.172,6.527-0.034,8.204,0.102c-0.002,0.337-0.033,0.666-0.051,0.999 c-1.671-0.138-4.775-0.28-8.359-0.089c-0.089,0.336-0.197,0.663-0.325,0.98c3.546,0.046,6.665,0.389,8.548,0.689 c-0.043,0.332-0.093,0.661-0.151,0.987c-1.912-0.306-5.171-0.664-8.879-0.682C35.112,30.873,31.557,32.75,26,32.969V33 c2.6,0,5,3.9,5,6.6V45c0,0.823,0.498,1.53,1.209,1.836C41.37,43.804,48,35.164,48,25C48,12.318,37.683,2,25,2S2,12.318,2,25 C2,35.164,8.63,43.804,17.791,46.836z"/>
                    </svg>
                    Continue with GitHub
                </button>
            </div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-app.js";
        import { getAuth, GoogleAuthProvider, GithubAuthProvider, signInWithPopup } 
        from "https://www.gstatic.com/firebasejs/11.3.1/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyDBO3FXBPODN55_-OAenRe7M61si-68Dzo",
            authDomain: "roomate-ec8df.firebaseapp.com",
            projectId: "roomate-ec8df",
            storageBucket: "roomate-ec8df.firebasestorage.app",
            messagingSenderId: "732405438098",
            appId: "1:732405438098:web:fe6f101ae4e71fad02f84b",
            measurementId: "G-MP72NF0HYW"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        window.signInWithGoogle = async function() {
            const provider = new GoogleAuthProvider();
            try {
                const result = await signInWithPopup(auth, provider);
                await handleSocialLoginSuccess(result.user, 'google');
            } catch (error) {
                console.error(error);
                alert("Failed to sign in with Google: " + error.message);
            }
        }

        window.signInWithGithub = async function() {
            const provider = new GithubAuthProvider();
            try {
                const result = await signInWithPopup(auth, provider);
                await handleSocialLoginSuccess(result.user, 'github');
            } catch (error) {
                console.error(error);
                alert("Failed to sign in with GitHub: " + error.message);
            }
        }

        async function handleSocialLoginSuccess(user, provider) {
            const response = await fetch('/auth/social-login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    firebase_uid: user.uid,
                    email: user.email,
                    name: user.displayName,
                    provider: provider
                })
            });
            
            const data = await response.json();
            if (data.success) {
                window.location.href = '/home';
            } else {
                throw new Error(data.message || 'Login failed');
            }
        }
    </script>
</body>
</html>
