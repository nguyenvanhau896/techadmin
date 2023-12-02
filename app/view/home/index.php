<?php require_once '../app/component/checkAdminLogin.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../app/component/head.php';?>
    <title>Home | TECHSHOP</title>
    
</head>
<body class="overflow-x-hidden bg-[#e2f9ec]">
    <?php require_once '../app/component/nav.php'?>
    <div class="p-10">
        <p class="text-4xl text-[#113c2a] text-center mb-8 font-semibold">Chào mừng quản trị viên</p>
        <div class="grid grid-rows-2 grid-flow-col gap-5 px-20">
            <div class="w-auto col-span-1 bg-[#55dca2] rounded-3xl transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-110 hover:bg-[#55dc6a] duration-300">
                <a href="#" class="p-4 flex flex-col items-center align-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/6433/6433996.png" alt="icon" class="w-1/3 mb-2">
                    <p class="text-lg font-semibold">Danh sách người dùng</p>
                </a>
            </div>
            <div class="col-span-1 bg-[#55dca2] rounded-3xl transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-110 hover:bg-[#55dc6a] duration-300">
                <a href="/techadmin/admin/product/index" class="p-4 flex flex-col items-center align-center">
                    <img src="https://static.thenounproject.com/png/1375595-200.png" alt="icon" class="w-1/3 mb-2">
                    <p class="text-lg font-semibold">Sản phẩm đang bán</p>
                </a>
            </div>
            <div class="col-span-1 bg-[#55dca2] rounded-3xl transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-110 hover:bg-[#55dc6a] duration-300">
                <a href="/techadmin/admin/news/index" class="p-4 flex flex-col items-center align-center">
                    <img src="https://cdn2.iconfinder.com/data/icons/picol-vector/32/news-512.png" alt="icon" class="w-1/3 mb-2">
                    <p class="text-lg font-semibold">Tin tức</p>
                </a>
            </div>
            <div class="col-span-1 bg-[#55dca2] rounded-3xl transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-110 hover:bg-[#55dc6a] duration-300">
                <a href="#" class="p-4 flex flex-col items-center align-center">    
                    <img src="https://cdn-icons-png.flaticon.com/512/7269/7269995.png" alt="icon" class="w-1/3">
                    <p class="text-lg font-semibold">Thông tin liên hệ</p>
                </a>
            </div>
            <div class="row-span-2 bg-[#55dca2] rounded-3xl transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-110 hover:bg-[#55dc6a] duration-300">
                <a href="#" class="p-4 flex flex-col items-center align-center h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-1/3" viewBox="0 0 448 512"><style>svg{fill:#162641}</style><path d="M384 480c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0zM224 352c-6.7 0-13-2.8-17.6-7.7l-104-112c-6.5-7-8.2-17.2-4.4-25.9s12.5-14.4 22-14.4l208 0c9.5 0 18.2 5.7 22 14.4s2.1 18.9-4.4 25.9l-104 112c-4.5 4.9-10.9 7.7-17.6 7.7z"/></svg>
                    <p class="text-lg font-semibold">Chức năng khác</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>