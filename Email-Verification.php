<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-[#000113]  sm:bg-[#1E293B]">
    <div class="flex justify-items-center h-screen">
        <div class="bg-[#000113] m-auto p-4 rounded w-screen  sm:w-96">
            <form action="backend/server.php" method="POST">
                <h1 class="text-white text-3xl">Enter Verification Code</h1>
                <p class="text-white">we have sent a verification code to <?php echo isset($_SESSION['email'])?$_SESSION['email']: '####@.com' ?></p>
                <p class="text-white">please go check your email</p>
                <input type="password" class="block p-2 w-full bg-transparent border-b-2 border-white text-white focus:outline-none" placeholder="#####" name="code">
                <p class="text-red-800"><?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''  ?></p>
                <input type="submit" class="p-2 bg-[#334155] hover:bg-[#263449] rounded transition duration-500 mt-2" name="resend" value="Resend">
                <input type="submit" class="mt-2 w-full bg-[#334155] p-2 hover:bg-[#263449] rounded transition duration-500 " name="verify-code" value="Verify">
            </form>
        </div>
    </div>
</body>

</html>