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
        <p class="text-3xl mb-4 font-semibold">Bảng sản phẩm của Techshop</p>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-[#55dca2]">
            <div class="flex items-center pt-2 px-6 pb-4 mt-1">
                <label for="table-search" class="sr-only">Search</label>
                <div class="absolute rtl:inset-r-0 start-6 z-10 flex items-center ps-3 pointer-events-none">    
                    <svg class="w-4 h-4 text-[#266e4f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <div class="relative mr-auto">
                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-[#1c543c] rounded-lg w-80 bg-[#93e7be] focus:ring-[#02110a] focus:border-[#02110a]" placeholder="Search for items">
                </div>
                <button type="button" class="add-button mt-1 text-lg text-black bg-[#55dc6a] hover:bg-[#b1dc55] border border-[#082619] focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full px-5 py-2.5 text-center me-2 mb-2">Add Product</button>
            </div>
            <table class="w-full text-md text-left rtl:text-right text-gray-500">
                <thead class="text-md text-black uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-[#93e7be]">
                        <td class="px-6 py-4">
                            1
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                        <td class="text-center px-6 py-4">
                            <a href="#" class="text-center font-medium text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
</script>
</html>