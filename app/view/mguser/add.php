<?php require_once '../app/component/checkAdminLogin.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../app/component/head.php';?>
    <title>Document</title>
</head>
<body class="bg-gray-300">
    <?php require_once '../app/component/nav.php';?>
    <main class="mx-auto bg-blue-300 w-[max-content] mt-[1rem] rounded-lg pb-4">
        <p class="text-[4rem] md:text-xl font-bold text-center mb-3 bg-green-100 rounded-tr-lg rounded-tl-lg">Tạo tài khoản mới</p>
        <form action="/techadmin/admin/mguser/register" method="post" class="w-[max-content] mx-auto">
            <div class="mx-4">
                <label for="uname" class="text-4xl md:text-lg font-semibold w-[100px] md:w-[200px] inline-block">Username</label>
                <input type="text" placeholder="type username" id="uname" name="uname" class="border-2 border-gray-900 rounded-lg transition duration-700 ease-in-out focus:scale-x-125 md:w-[200px] px-5 py-1 mb-4">
            </div>
            <div class="mx-4">
                <label for="fname" class="text-4xl md:text-lg font-semibold w-[100px] md:w-[200px] inline-block">First Name</label>
                <input type="text" placeholder="type first name" id="fname" name="fname" class="border-2 border-gray-900 rounded-lg transition duration-700 ease-in-out focus:scale-x-125 md:w-[200px] px-5 py-1 mb-4">
            </div>
            <div class="mx-4">
                <label for="email" class="text-4xl md:text-lg font-semibold w-[100px] md:w-[200px] inline-block">Email</label>
                <input type="email" placeholder="abc@gmail.com" id="email" name="email" class="border-2 border-gray-900 rounded-lg transition duration-700 ease-in-out focus:scale-x-125 md:w-[200px] px-5 py-1 mb-4">
            </div>
            <div class="mx-4">
                <label for="lname" class="text-4xl md:text-lg font-semibold w-[100px] md:w-[200px] inline-block">Last Name</label>
                <input type="text" placeholder="example: Password123" id="lname" name="lname" class="border-2 border-gray-900 rounded-lg transition duration-700 ease-in-out focus:scale-x-125 md:w-[200px] px-5 py-1 mb-4">
            </div>
            <div class="mx-4">
                <label for="password" class="text-4xl md:text-lg font-semibold w-[100px] md:w-[200px] inline-block">Password</label>
                <input type="password" placeholder="example: Password123" id="password" name="password" class="border-2 border-gray-900 rounded-lg transition duration-700 ease-in-out focus:scale-x-125 md:w-[200px] px-5 py-1 mb-4">
            </div>
            <div class="mx-4">
                <label for="confirm" class="text-4xl md:text-lg font-semibold w-[100px] md:w-[200px] inline-block ">Confirm Password</label>
                <input type="password" placeholder="type username" id="confirm" class="border-2 border-gray-900 rounded-lg transition duration-700 ease-in-out focus:scale-x-125 md:w-[200px] px-5 py-1 mb-4">
            </div>
            <div class="mx-auto w-[max-content]">
                <div role="button" class="inline-block"><a href="/techadmin/admin/mguser/index" class="px-5 py-1 border-2 border-black rounded-lg cursor-pointer bg-yellow-500 hover:bg-yellow-700 active:bg-yellow-300">Trở về</a></div>
                <button type="submit" class="px-5 py-1 border-2 border-black rounded-lzg cursor-pointer bg-green-600 hover:bg-green-700 active:bg-green-300 ms-5">Tạo mới</button>
            </div>
            
        </form>
    </main>
    
</body>
</html>