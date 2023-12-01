<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | Techshop</title>
    <?php require_once '../app/component/head.php';?>
</head>
<body class="bg-[#e2f9ec]">
    <?php require_once '../app/component/nav.php';?>
    <div class="main m-8">
        <div class="px-32 py-8 bg-[#55dca2] overflow-x-auto shadow-md sm:rounded-lg">
            <p class="text-3xl mb-4">Thông tin sản phẩm</p>
            <form class="w-full" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-product-name">
                        Tên sản phẩm
                    </label>
                    <input name="name" class="name appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Iphone 14">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-price">
                        Giá tiền
                    </label>
                    <input name="price" class="price appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="40.000.000">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-screen">
                            Màn hình
                        </label>
                        <input name="screen" class="screen appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="14-inch, full HD, 144GHz">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-image">
                            Link hình ảnh
                        </label>
                        <input name="image" class="image appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="https://ctmobile.vn/upload/iPhone%2014/iphone14-white-ctmobile-vn.png">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                            Category
                        </label>
                        <div class="relative">
                            <select name="category" required class="category-select block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">---</option>
                                <option value="Phone">Phone</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Tablet">Tablet</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="category-based flex flex-wrap -mx-3 mb-6">
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="desblock uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-product-name">
                        Mô tả sản phẩm
                    </label>
                    <textarea name="description" rows="4" class="des appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="Describe about your product..."></textarea>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0 flex">
                        <button class="mr-auto bg-[#b4efd0] hover:bg-[#b1dc55] text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" onClick="window.location.href = '/techadmin/admin/product/index';">
                            <img src="https://cdn-icons-png.flaticon.com/512/61/61449.png" alt="icon" class="w-4 h-4 mr-3">
                            <span>Trở về</span>
                        </button>
                        <button type="submit" class="add-product bg-[#b4efd0] hover:bg-[#b1dc55] text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <img src="https://icons.veryicon.com/png/o/miscellaneous/8atour/submit-successfully.png" alt="icon" class="w-4 h-4 mr-3">
                            <span>Thêm sản phẩm</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).on('click', '.add-button', function (){
        var main = this.closest('.main');
        $.ajax({
            method: "POST",
            url: "/techadmin/app/view/product/addProduct.php",
            success: function (response){
                main.innerHTML = response;
            }
        })
    });
    $(document).on('change', '.category-select', function(){
        var value = this.value;
        var category = document.querySelector('.category-based');
        if (value != ""){
            $.ajax({
                method: "POST",
                url: "/techadmin/app/view/product/" + value + ".php",
                success: function (response){
                    category.innerHTML = response;
                } 
            })
        }else category.innerHTML = "";
    });
    $(document).on('click', '.add-product', function(e){
        const category = document.querySelector('.category-select').value;
        const name = document.querySelector('.name').value;
        const price = document.querySelector('.price').value;
        const screen = document.querySelector('.screen').value;
        const image = document.querySelector('.image').value;
        const des = document.querySelector('.des').value;
        switch (category){
            case "Phone":
                var screenType = document.querySelector('.screenType').value;
                var storage = document.querySelector('.storage').value;
                $.ajax({
                    method: "POST",
                    url: "/techadmin/app/view/product/handleProduct.php",
                    data: {
                        "name": name,
                        "price": price,
                        "screen": screen,
                        "image": image,
                        "des": des,
                        "category": category,
                        "screenType": screenType,
                        "storage": storage,
                        "scope": "add"
                    },
                    success: function (response){
                        if (response == '200') {
                            alert('Phone Added!');
                            window.location.href = "/techadmin/admin/product/index";
                        }
                        else alert('Something went wrong');
                    }
                })
                break;
            case "Laptop":
                var cpu = document.querySelector('.cpu').value;
                var screenCard = document.querySelector('.screenCard').value;
                var battery = document.querySelector('.battery').value;
                var weight = document.querySelector('.weight').value;
                $.ajax({
                    method: "POST",
                    url: "/techadmin/app/view/product/handleProduct.php",
                    data: {
                        "name": name,
                        "price": price,
                        "screen": screen,
                        "image": image,
                        "des": des,
                        "category": category,
                        "cpu": cpu,
                        "screenCard": screenCard,
                        "battery": battery,
                        "weight": weight,
                        "scope": "add"
                    },
                    success: function (response){
                        if (response == '200') {
                            alert('Laptop Added!');
                            window.location.href = "/techadmin/admin/product/index";
                        }
                        else alert('Something went wrong');
                    }
                })
                break;
            case "Tablet":
                var screenType = document.querySelector('.screenType').value;
                var storage = document.querySelector('.storage').value;
                var connect = document.querySelector('.connect').value;
                $.ajax({
                    method: "POST",
                    url: "/techadmin/app/view/product/handleProduct.php",
                    data: {
                        "name": name,
                        "price": price,
                        "screen": screen,
                        "image": image,
                        "des": des,
                        "category": category,
                        "screenType": screenType,
                        "storage": storage,
                        "connect": connect,
                        "scope": "add"
                    },
                    success: function (response){
                        if (response == '200') {
                            alert('Tablet Added!');
                            window.location.href = "/techadmin/admin/product/index";
                        }
                        else alert('Something went wrong');
                    }
                })
                break;
        }
    });
</script>