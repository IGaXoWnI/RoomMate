<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F5EFE7] font-sans m-0 p-0 flex justify-center items-center min-h-screen">
    <div class="flex justify-center items-center min-h-screen bg-[#F5EFE7]">

        <form action="/handleOtp" method="POST" class="bg-white p-6 rounded-lg shadow-md w-96">
            <h2 class="text-xl font-bold mb-4">Verify Your Email</h2>

            <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
                <?php unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <label for="otp" class="block text-gray-700">Enter OTP</label>
            <input type="text" id="otp" name="code" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Enter the OTP" required>

            <button type="submit" name="OTP" class="w-full bg-[#213555] text-white py-2 mt-4 rounded">Verify</button>
        </form>
    </div>
</body>
</html>
