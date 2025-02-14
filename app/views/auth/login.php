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

            <!-- Add social login buttons -->
            <div class="flex flex-col gap-4 mt-6">
                <button onclick="signInWithGoogle()" class="flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <img src="/assets/images/google.svg" alt="Google" class="w-5 h-5">
                    Continue with Google
                </button>
                
                <button onclick="signInWithGithub()" class="flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <img src="/assets/images/github.svg" alt="GitHub" class="w-5 h-5">
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
