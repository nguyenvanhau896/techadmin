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
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-[#66c99b]">
            <div class="flex items-center pt-2 px-6 pb-4 mt-1">
                <label for="table-search" class="sr-only">Search</label>
                <div class="absolute rtl:inset-r-0 start-6 z-10 flex items-center ps-3 pointer-events-none">    
                    <svg class="w-4 h-4 text-[#266e4f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <div class="relative mr-4">
                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-[#1c543c] rounded-lg w-80 bg-[#93e7be] focus:ring-[#02110a] focus:border-[#02110a]" placeholder="Search for items">
                </div>
                <select id="records-per-page" class="mr-auto block pt-2 text-sm text-gray-900 border border-[#1c543c] rounded-lg bg-[#93e7be] focus:ring-[#02110a] focus:border-[#02110a]">
                    <option value="5">5 Records/Page</option>
                    <option value="10" selected>10 Records/Page</option>
                    <option value="15">15 Records/Page</option>
                </select>
                <a href="/techadmin/admin/product/addProduct">
                    <button type="button" class="add-button mt-1 text-lg text-black bg-[#55dc6a] hover:bg-[#b1dc55] border border-[#082619] focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full px-5 py-2.5 text-center me-2 mb-2">Add Product</button>
                </a>
            </div>
            <table class="w-full text-md text-left rtl:text-right text-[#082619]">
                <thead class="text-md text-black uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Price
                        </th>
                        <th scope="col" class="text-center px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $server_name = "localhost";
                        $user_name = "root";
                        $password = "";
                        $database = "techshop";       
                        $conn = mysqli_connect($server_name, $user_name, $password, $database);
                        if (!$conn) {
                            echo "Connection failed!";
                        }
                        if ($numberOfRecords = $conn->query("SELECT COUNT(*) as total FROM `product`")){
                            $numberOfRecords = mysqli_fetch_assoc($numberOfRecords)["total"];
                            $query = "SELECT * FROM `product` LIMIT 10";
                            if ($query_product = $conn->query($query)){
                                $recordPerPage = 10;
                                $currentPage = 1;
                                while($row = mysqli_fetch_assoc($query_product)){
                    ?>
                    <input class="number-of-records hidden" value="<?=$numberOfRecords?>">
                    <tr class="product-cell border-b hover:bg-[#93e7be]">
                        <td class="px-6 py-4 w-[5%]">
                            <?=$row["id"];?>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-[35%]">
                            <?=$row["name"];?>
                        </th>
                        <td class="px-6 py-4 flex justify-start w-1/10">
                            <img src="<?=$row["image"];?>" alt="image" class="w-10 h-10">
                        </td>
                        <td class="px-6 py-4 text-center w-1/10">
                            <?=$row["category"];?>
                        </td>
                        <td class="px-6 py-4 text-right w-1/5">
                            <?=number_format($row["price"], 0, '', '.') . ' ₫';?>
                        </td>
                        <td class="text-center px-6 py-4 w-1/5">
                            <a href="/techadmin/admin/product/editProduct?id=<?=$row["id"]?>" class="text-center font-medium text-blue-600 hover:underline mr-4">Edit</a>
                            <button class="delete text-center font-medium text-red-600 hover:underline" value="<?=$row["id"]?>">Delete</button>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="flex flex-row mx-auto items-center justify-center m-4">
                <button type="button" class="prev-button bg-[#113c2a] text-white rounded-l-md border-r border-gray-100 py-2 hover:bg-[#b1dc55] hover:text-black px-3">
                <div class="flex flex-row align-middle">
                    <svg class="w-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="ml-2">Prev</p>
                </div>
                </button>
                <span>
                    <input type="number" class="current-page bg-transparent w-12 text-center text-black border-none" disabled value="<?=$currentPage?>">/
                    <input type="number" class="max-page bg-transparent w-12 text-center text-black border-none" disabled value="<?=ceil($numberOfRecords/$recordPerPage)?>" >
                </span>
                <button type="button" class="next-button bg-[#113c2a] text-white rounded-r-md py-2 border-l border-gray-200 hover:bg-[#b1dc55] hover:text-black px-3">
                <div class="flex flex-row align-middle">
                    <span class="mr-2">Next</span>
                    <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                </button>
            </div>
        </div>
    </div>
</body>
<script>
var page = 1;

$(document).on('input', '#table-search', function () {
    page = 1;
    document.querySelector('.current-page').value = page;
    loadTableData(page); // Reset to the first page when searching
});

$(document).on('change', '#records-per-page', function () {
    page = 1;
    document.querySelector('.current-page').value = page;
    loadTableData(page); // Reset to the first page when changing records per page
});

$(document).on('click', '.next-button', function () {
    var maxPage = $('.max-page').val();
    if (page < maxPage)
        page++;
        document.querySelector('.current-page').value = page;
        loadTableData(page); // to next page
});

$(document).on('click', '.prev-button', function () {
    var maxPage = $('.max-page').val();
    if (page > 1)
        page--;
        document.querySelector('.current-page').value = page;
        loadTableData(page); // to previous page
});

function loadTableData(page) {
    var searchValue = $('#table-search').val();
    var recordsPerPage = $('#records-per-page').val();
    var numberOfRecords = $('.number-of-records').val();
    document.querySelector('.max-page').value = Math.ceil(numberOfRecords/recordsPerPage);

    $.ajax({
        method: "POST",
        url: "/techadmin/app/view/product/searchProduct.php",
        data: {
            search: searchValue,
            page: page,
            recordsPerPage: recordsPerPage
        },
        success: function (response) {
            // Update the tbody with the search results
            $('tbody').html(response);
        }
    });
}

// Handle pagination when a page number is clicked
$(document).on('click', '.pagination-link', function () {
    var page = $(this).data('page');
    loadTableData(page);
});

$(document).on('click', '.delete', function () {
    var id = $(this).val();
    var product = $(this).closest('.product-cell');
    product.remove();
    $.ajax({
        method: "POST",
        url: "/techadmin/app/view/product/handleProduct.php",
        data: {
            "id": id,
            "scope": "delete"
        },
        success: function (response){
            if (response == '200') alert('Product Deleted');
            else alert('Something went wrong');
        }
    });
});
</script>
</html>