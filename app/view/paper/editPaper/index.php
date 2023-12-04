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
    }
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $name = $_POST['name'];
        $image = $_POST['image'];
        $dateRelease = $_POST['dateRelease'];
        $description = $_POST['description']; 
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $flag = true;
        // /////////////////////////////////////////////////////////////////////////////////
        function checkBirhday(){
            
            $day1 = (int)$_POST['day'];
            $month1 = (int)$_POST['month'];
            $year1 = (int)$_POST['year'];
            
            if($day1 != 0 && $month1 != 0 && $year1 != 0) 
            {
                $maxDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month1, $year1);
                return $day1 <= $maxDaysInMonth;
            }
            else if($day1 == 0 && $month1 == 0 && $year1 == 0) return true;
            else
            return false;
        }
        // /////////////////////////////////////////////////////////////////////////////////


        
        if(!checkBirhday()){
            $flag = false;
            $dayEr = 'invalid day';
            
        }
        if($day != '' && $month != '' && $year != '') {
            $dateRelease = $year.'-'.$month.'-'.$day;
        }
        
        
        // Truy vấn để chỉnh sửa dữ liệu
        if($flag){
            $sql = "UPDATE paper SET name=:name, dateRelease=:dateRelease ,description=:description, image=:image WHERE id=$id";
            $stmt1 = $conn->prepare($sql);
            $stmt1->bindParam(':name', $name);
            $stmt1->bindParam(':description', $description);
            $stmt1->bindParam(':dateRelease', $dateRelease);
            $stmt1->bindParam(':image', $image);
            $stmt1->execute();
            
            echo " <span style='color:green;'>Edit Success</span> ";
        }
        
    }
?>

<div class="flex flex-row mx-auto">
    <div class=" p-2 flex flex-row mx-auto  justify-center ">
    
    <form method="post" class="w-[40rem]">

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
        echo ' <label for="name" class="text-[1.4rem] font-medium">Tiêu đề bài viết</label> <br> <textarea id="name" name="name" type="text" class="w-[34rem] text-6xl font-semibold bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" cols="24" rows="4">'.$paper['name'] .'</textarea>';

        echo ' <div class="content">  ';
        
        echo '<div class="text-[1.4rem] font-medium">Ngày đăng: </div> <input readonly="readonly" id="dateRelease" name="dateRelease" type="text" value="'.$paper['dateRelease'].'" class="text-gray-600 text-[1rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"> ';
        ?>

        <!-- ---------------------------------------DATE RELEASE------------------------------------------------------------- -->
        <div class="flex mt-1">
                    <!-- -------------------------year-------------------------------------- -->
                    <div class="ms-2">
                        <label for="year">Year:</label>
                        <select class="text-gray-600 text-[1rem] text-center w-[8rem] h-[2rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" id="year" name ="year">
                        <?php 
                            $selectedYear = isset($_POST['year']) ? $_POST['year'] : '';
                            echo "<option value=\"$selectedYear\" selected>$selectedYear</option>";
                            for($i=2023; $i>=1970;$i--){
                                echo "<option value=\"$i\">$i</option>";
                            }
                        ?>
                        </select>
                    </div>
                    
                    <!-- -------------------------month------------------------------------- -->
                    <div class="ms-2">
                        <label for="month">Month:</label>
                        <select class="text-gray-600 text-[1rem] text-center w-[6rem] h-[2rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" id="month" name ="month">
                        <?php
                    // Giả sử $selectedDay là giá trị mà bạn muốn chọn mặc định
                    $selectedmonth = isset($_POST['month']) ? $_POST['month'] : '';
                    echo "<option value=\"$selectedmonth\" selected>$selectedmonth</option>";
                    for($i=1; $i<=12;$i++){
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>      
                        </select>
                    </div>
    
                    <!-- --------------------------day--------------------------------- -->
                    <div>
                    <label for="day">Day:</label>
                        <select class="text-gray-600 text-[1rem] text-center w-[6rem] h-[2rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" id="day" name="day">
                                    <?php
                    // Giả sử $selectedDay là giá trị mà bạn muốn chọn mặc định
                    $selectedDay = isset($_POST['day']) ? $_POST['day'] : '';
                    echo "<option value=\"$selectedDay\" selected>$selectedDay</option>";
                    for($i=1; $i<=31;$i++){
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>

                        </select>
                    </div>
                
                </div>
                <div class="text-red-700"> <?php echo '*'.$dayEr ?> </div>
                <!-- -----------------------------------------------END dateRelease-------------------------------------------------- -->
        <?php 
        echo ' <div class="text-[1.4rem] font-medium">Link hình ảnh</div> ';
        echo '<div class="flex justify-center flex-col ">';
        echo '<input id="image" name="image" type="text" value="'.$paper['image'].'" class="text-gray-600 text-[1rem] w-[34rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" > ';
        echo ' <div  class="flex justify-center flex-col text-center items-center">';
        echo ' <div class="text-[1.4rem] font-medium">Hình ảnh hiển thị</div> ';
        echo '<img src="'.$paper['image'].'" alt="Picture" class="w-[24rem]">';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="text-[2rem] font-medium">Đặc điểm nổi bật</div>';
        echo '<textarea id="description" name="description" type="text" class=" w-[34rem] text-[1rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" cols="90" rows="16">'.$paper['description'] .'</textarea>';;
        echo '</div>';
        echo '</div>';
    }
?>
<div class="flex flex-row">

    <a href="/techadmin/admin/news/index" class="flex justify-center items-center m-[1rem]">
    <button type="button" class="text-[2rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-[#3DBC72] rounded-lg hover:bg-[#55DCA2] hover:scale-110  w-[16rem] text-center flex flex-row justify-center">
                        Quay lai
                        <svg xmlns="http://www.w3.org/2000/svg" class="ms-[1.4rem] w-[3rem] h-[2.6rem]" viewBox="0 0 77 73" fill="none">
                    <path d="M38.5 0C17.2287 0 0 16.2481 0 36.3085C0 56.369 17.2287 72.617 38.5 72.617C59.7713 72.617 77 56.369 77 36.3085C77 16.2481 59.7713 0 38.5 0ZM38.5 9.07713V27.2314H67.375V45.3856H38.5V63.5399L9.625 36.3085L38.5 9.07713Z" fill="white"/>
                    </svg>
    </button>
    </a>

    <div class="flex justify-center items-center m-[1rem]">
    <button type="submit" class="text-[2rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 hover:scale-110  w-[16rem] text-center flex flex-row justify-center">
                        Chỉnh sửa
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 70 70" fill="none" class="ms-[2rem] w-[2rem] h-[2.6rem]">
                    <path d="M52.2042 0L43.5035 8.7007L60.9049 26.1021L69.6056 17.4014L52.2042 0ZM34.8028 17.4014L0 52.2042V69.6056H17.4014L52.2042 34.8028L34.8028 17.4014Z" fill="white"/>
                    </svg>
    </button>
    </div>

    </div>

</form>

<!-- ----------------------------list papers------------------------------------------------ -->
<div class=" max-w-sm p-[1rem] bg-[#E2F9EC] border border-gray-220 rounded-lg shadow sm:p-6 " style=" max-height: 43rem;">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl">
            BÀI VIẾT ĐƯỢC XEM NHIỀU NHẤT
            </h5>
            
        <?php
            $query2 = "SELECT * FROM paper ORDER BY views DESC LIMIT 5";
            $stmt2 = $conn->query($query2);
 
            // Lấy tất cả các dòng dữ liệu từ kết quả truy vấn
            $papers2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            echo ' <ul class="my-4 space-y-3 flex flex-col content-center h-[38rem] items-center">';
            $i =1;
            forEach ($papers2 as $paper2Item) {
                // $query_string = http_build_query($paper2Item);
                // $query_string = $query_string.'"';
                echo '<li>
                <a href="/techadmin/admin/editPaper/index?id='.$paper2Item['id'].'" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-[#55dca2] hover:bg-[#266e4f] group hover:shadow ">
                <button class="btn bg-[#266e4f] w-8 h-8 rounded-md">'.$i.'</button>
                <span class="flex-1 ms-3">'.$paper2Item['name'].'</span>
                </a>
                </li>';
                $i++;
            }
        
            ?>
        </div>
        
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