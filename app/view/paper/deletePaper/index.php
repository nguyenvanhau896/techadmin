<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../app/component/head.php';?>
    <title>Paper</title>
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
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);?>

<?php
    $dayEr ='';
    if (isset($_GET['id'])){
    $id = $_GET['id'];
    if($_SERVER['REQUEST_METHOD']=='POST') {
        
        // Truy vấn để chỉnh sửa dữ liệu
        
        $sql = "DELETE FROM paper WHERE id=:id";
        $stmt1 = $conn->prepare($sql);
        $stmt1->bindParam(':id', $id);  
        $stmt1->execute();
        echo " <span style='color:green;'>Delete Success</span> ";
        
        
    }
}
?>

<div class=" p-2 flex flex-row mx-auto">
    <div class=" p-2 flex flex-row mx-auto  justify-center ">
    
    <form method="post">

    <?php
     if (isset($_GET['id'])) {
        // Lấy tất cả thông tin của sản phẩm từ query string
        
        $id = $_GET['id'];
        $query = "SELECT * FROM paper WHERE id=:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);   
        $stmt->execute();
        $paper = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '<div class="main w-[100%]">';
        echo ' <label for="name" class="text-[1.4rem] font-medium">Tiêu đề bài viết</label> <br> <textarea readonly id="name" name="name" type="text" class="text-6xl font-semibold bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"cols="24" rows="4">'.$paper['name'] .'</textarea>';

        echo ' <div class="content">  ';
        
        echo '<div class="text-[1.4rem] font-medium">Ngày đăng: </div> <input readonly="readonly" id="dateRelease" name="dateRelease" type="text" value="'.$paper['dateRelease'].'" class="text-gray-600 text-[1rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"> ';
        ?>

        <?php 
        echo ' <div class="text-[1.4rem] font-medium">Link hình ảnh</div> ';
        echo '<div class="flex justify-center flex-col ">';
        echo '<input readonly id="image" name="image" type="text" value="'.$paper['image'].'" class="text-gray-600 text-[1rem] w-[40rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" > ';
        echo ' <div  class="flex justify-center flex-col text-center items-center">';
        echo ' <div class="text-[1.4rem] font-medium">Hình ảnh hiển thị</div> ';
        echo '<img src="'.$paper['image'].'" alt="Picture" class="w-[24rem]">';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="text-[2rem] font-medium">Đặc điểm nổi bật</div>';
        echo '<textarea readonly id="description" name="description" type="text" class="text-[1rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" cols="90" rows="16">'.$paper['description'] .'</textarea>';;
        echo '</div>';
        echo '</div>';
    }
?>
<div class="flex flex-row">

    <a href="/techadmin/admin/news/index" class="flex justify-center items-center m-[2rem]">
    <button type="button" class="text-[2.4rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-[#3DBC72] rounded-lg hover:bg-[#55DCA2] hover:scale-110  w-[20rem] text-center flex flex-row justify-center">
                        Quay lai
                        <svg xmlns="http://www.w3.org/2000/svg" class="ms-[1.4rem] w-[3rem] h-[2.6rem]" viewBox="0 0 77 73" fill="none">
                    <path d="M38.5 0C17.2287 0 0 16.2481 0 36.3085C0 56.369 17.2287 72.617 38.5 72.617C59.7713 72.617 77 56.369 77 36.3085C77 16.2481 59.7713 0 38.5 0ZM38.5 9.07713V27.2314H67.375V45.3856H38.5V63.5399L9.625 36.3085L38.5 9.07713Z" fill="white"/>
                    </svg>
    </button>
    </a>

    <div class="flex justify-center items-center m-[2rem]">
    <button type="submit" class="text-[2.4rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 hover:scale-110  w-[20rem] text-center flex flex-row justify-center">
                        Xóa
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 70 80" fill="none" class="ms-2 w-[2.6rem] h-[2rem]">
                <path d="M29.831 0C24.362 0 19.8873 4.47465 19.8873 9.94366H9.94366C4.47465 9.94366 0 14.4183 0 19.8873H69.6056C69.6056 14.4183 65.1309 9.94366 59.6619 9.94366H49.7183C49.7183 4.47465 45.2436 0 39.7746 0H29.831ZM9.94366 29.831V77.66C9.94366 78.7538 10.7391 79.5492 11.833 79.5492H57.8721C58.9659 79.5492 59.7614 78.7538 59.7614 77.66V29.831H49.8177V64.6338C49.8177 67.418 47.6301 69.6056 44.8459 69.6056C42.0617 69.6056 39.8741 67.418 39.8741 64.6338V29.831H29.9304V64.6338C29.9304 67.418 27.7428 69.6056 24.9586 69.6056C22.1744 69.6056 19.9867 67.418 19.9867 64.6338V29.831H10.0431H9.94366Z" fill="white"/>
                </svg>
    </button>
    </div>

    </div>

</form>
        
</div>

</div>


<?php
} catch (PDOException $e) {
    echo '<span style="color:red;"> fail: ' . $e->getMessage().'</span>';
}
?>
<!-- footer -->
<?php require_once '../app/component/footer.php'?>
</body>
</html>