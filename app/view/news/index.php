<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <?php require_once '../app/component/head.php';?>
    <style>
/* Large Devices, Wide Screens */ @media screen and (max-width: 1200px) {
    html {
        font-size: 16px;
    }    
}
/* Medium Devices, Desktops */ @media screen and (max-width: 992px) {
    html {
        font-size: 14px;
    }
}
/* Small Devices, Tablets */ @media screen and (max-width: 768px) {
    html {
        font-size: 10px;
    }
}
/* Extra Small Devices, Phones */ @media screen and (max-width: 480px){
    html {
        font-size: 6px;
    }
}
  

</style>
</head>
<body class="bg-[#E2F9EC]"> 


<?php require_once '../app/component/nav.php'?>

                        <?php 
                        $host = 'localhost';  // Nếu MySQL server chạy trên localhost
                        $dbname = 'techshop';
                        $username = 'root';   // Tên người dùng MySQL, thường là "root" cho localhost
                        $password = ''; 
                         try {
                            
                            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        
                            // Thiết lập chế độ lỗi để báo cáo tất cả các lỗi
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // $conn = null;
                         ?>
    <div class="text-[4rem] p-[2rem] font-bold text-slate-700">  Quản lí bài viết </div>
    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md ms-8 flex flex-row justify-center text-center items-center h-[5rem]"> 
        <a href="/techadmin/admin/addPaper/index" class="text-[1.6rem]"> Thêm bài viết mới </a>
        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 35 34" fill="none" class="w-[2rem] h-[2rem] ms-2">
        <path d="M13.125 0V12.6021H0V21.0035H13.125V33.6056H21.875V21.0035H35V12.6021H21.875V0H13.125Z" fill="white"/>
        </svg>
    </button>
    <div>   
        <div class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</div>
        <div class="relative flex justify-end mx-[4rem] ">
            <div class="absolute top-[1.4rem] right-[24rem] flex items-center ps-3 pointer-events-none">
                <svg class="w-[1.4rem] h-[1.4rem] text-white dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="searchTitle" class="block w-[26rem] py-[1rem] pr-[8rem] ps-10 text-gray-900 border border-gray-300 rounded-lg text-[1.6rem] " placeholder="Search title paper">
            <button id="search" type="button" class="text-white absolute right-[1rem] h-[2.8rem] w-[6rem] top-[0.6rem] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.2rem] px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </fdiv>
    <div class="text-[2.4rem] p-[2rem] pt-[1rem] font-bold text-slate-700"> Danh sách bài viết: </div>

    

    <div  class="flex flex-col ">
    <!------------------------- news list ---------------------------------------->
    <div  id="adContainer" class="flex flex-row justify-center container mx-auto mb-4 flex-wrap">
    <?php 
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 6;
    
    // Truy vấn CSDL
    $query1 = "SELECT * FROM paper  LIMIT $offset,$limit";
    //  $query1 = "SELECT DISTINCT * FROM paper order by RAND() limit 3";
     $stmt1 = $conn->query($query1);
 
     // Lấy tất cả các dòng dữ liệu từ kết quả truy vấn
     $papers = $stmt1->fetchAll(PDO::FETCH_ASSOC);
     forEach ($papers as $paperItem) {
        echo '<div class="relative min-h-full m-4 max-w-sm bg-[#c4f2d9]  hover:bg-[#81e4b4] hover:-translate-y-1 hover:scale-110 border border-gray-200 rounded-lg shadow mb-4 w-[24rem]">
        <a href="" class="d-flex">';
        echo '<img class="rounded-t-lg p-3 max-w-20" src="'.$paperItem['image'].'" anh san pham" />';
        echo '</a>';
        echo '<div class="px-4 pb-10">
                <a href="">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">'.$paperItem['name'].'</h5>
                </a>';
        echo '<p class="mb-3 font-normal text-gray-700 ">'.substr($paperItem['description'],27,120).'...</p>';
        echo '<a href="/techadmin/admin/editPaper/index?id='.$paperItem['id'].'" class="absolute text-[1.2rem] bottom-2 left-[2rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-[8.6rem] text-center flex flex-row justify-center">
                    Chỉnh sửa
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 70 70" fill="none" class="ms-2 w-[1rem] h-[1.6rem]">
                <path d="M52.2042 0L43.5035 8.7007L60.9049 26.1021L69.6056 17.4014L52.2042 0ZM34.8028 17.4014L0 52.2042V69.6056H17.4014L52.2042 34.8028L34.8028 17.4014Z" fill="white"/>
                </svg>
                </a>';
        echo '<a href="/techadmin/admin/deletePaper/index?id='.$paperItem['id'].' " class="absolute text-[1.2rem] bottom-2 right-[2rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-[8.6rem] text-center flex flex-row justify-center">
                Xóa
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 70 80" fill="none" class="ms-2 w-[1rem] h-[1.6rem]">
                <path d="M29.831 0C24.362 0 19.8873 4.47465 19.8873 9.94366H9.94366C4.47465 9.94366 0 14.4183 0 19.8873H69.6056C69.6056 14.4183 65.1309 9.94366 59.6619 9.94366H49.7183C49.7183 4.47465 45.2436 0 39.7746 0H29.831ZM9.94366 29.831V77.66C9.94366 78.7538 10.7391 79.5492 11.833 79.5492H57.8721C58.9659 79.5492 59.7614 78.7538 59.7614 77.66V29.831H49.8177V64.6338C49.8177 67.418 47.6301 69.6056 44.8459 69.6056C42.0617 69.6056 39.8741 67.418 39.8741 64.6338V29.831H29.9304V64.6338C29.9304 67.418 27.7428 69.6056 24.9586 69.6056C22.1744 69.6056 19.9867 67.418 19.9867 64.6338V29.831H10.0431H9.94366Z" fill="white"/>
                </svg>
            </a>';
        echo '</div>';
        echo '</div>';
        
     }
    ?>
    
</div>
<div class="flex justify-center">
<button id="loadMoreBtn" class="m-4 px-4 py-2 bg-blue-500 text-white rounded-md w-[12rem] text-center hover:-translate-y-1">Xem thêm</button>

</div>

</div>
<?php
} catch (PDOException $e) {
    echo '<span style="color:red;"> fail: ' . $e->getMessage().'</span>';
}
?>

<script>
$(document).ready(function () {
    var offset = 0; // Khai báo offset và limit ở đây
    var limit = 9;
    $("#loadMoreBtn").on("click", function () {
        // Gọi Ajax để lấy dữ liệu mới
        $.ajax({
            type: "GET",
            url: "/techadmin/app/view/news/ajax.php", // Đặt đường dẫn đến script xử lý truy vấn CSDL ở đây
            data: { offset: offset, limit: limit },
            success: function (data) {
                // Thêm dữ liệu mới vào container
                $("#adContainer").html(data);
                
                // Cập nhật offset
                 limit+=3;
            }
        });
    });
// ///////////////////////////////////////////SEARCH/////////////////////////////////////////////////////
    
    var title='';
    $("#search").on("click", function () {
        // Gọi Ajax để lấy dữ liệu mới
        title = document.querySelector('#searchTitle').value;
        
        if(title.length > 0){
            $.ajax({
            type: "GET",
            url: "/techadmin/app/view/news/ajaxSearch.php", // Đặt đường dẫn đến script xử lý truy vấn CSDL ở đây
            data: { title: title },
            success: function (data) {
                // Thêm dữ liệu mới vào container
                $("#adContainer").html(data);
                
            }
        });
        }
        
    });

});

</script>

    
    
<?php require_once '../app/component/footer.php'?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
</body>
</html>