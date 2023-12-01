<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../app/component/head.php';?>
    <title>Paper</title>
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
    $dayEr =$nameEr= $imageEr= $dateReleaseEr= $descriptionEr='';
    $name= $image= $dateRelease= $description= $day= $month= $year='';
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
            
            $day = (int)$_POST['day'];
            $month = (int)$_POST['month'];
            $year = (int)$_POST['year'];
            
            if($day != 0 && $month != 0 && $year != 0) 
            {
                $maxDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                return $day <= $maxDaysInMonth;
            }
            else
            return false;
        }
        // /////////////////////////////////////////////////////////////////////////////////


        if(strlen($name) == 0) {
            $flag = false;
            $nameEr = 'invalid title';
        }

        if (strlen($image) == 0) {
            $flag = false;
            $imageEr = 'invalid image';
        }

        if(strlen($description) == 0) {
            $flag = false;
            $descriptionEr = 'invalid description';
        }
        if(!checkBirhday()){
            $flag = false;
            $dayEr = 'invalid day';
            
        }
        if($day != '' && $month != '' && $year != '') {
            $dateRelease = $year.'-'.$month.'-'.$day;
        }
        
        // Truy vấn để chỉnh sửa dữ liệu
        if($flag){

            ///////////////////////////////////////CHECK SAME NAME////////////////////////////////////////////////////////////

            // Kiểm tra sự tồn tại của name
            $checkSameName = "SELECT COUNT(*) as count FROM paper WHERE name = :name";
            $stmt2 = $conn->prepare($checkSameName);
            $stmt2->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt2->execute();

            $result = $stmt2->fetch(PDO::FETCH_ASSOC);
            $count = $result['count'];

            if($count == 0){
                /////////////////////////////////////////////////insert/////////////////////////////////////////////////////////////////
                $sql = "INSERT INTO paper  (name, dateRelease ,description, image) VALUES (:name,:dateRelease,:description,:image)";
                $stmt1 = $conn->prepare($sql);
                $stmt1->bindParam(':name', $name);
                $stmt1->bindParam(':description', $description);
                $stmt1->bindParam(':dateRelease', $dateRelease);
                $stmt1->bindParam(':image', $image);
                $stmt1->execute();
                
                echo " <span style='color:green;'>Add Success</span> ";
            }
            else {
                echo ' <div class="text-red-700">Đã tồn tại bài viết có tiêu đề này, vui lòng chọn tiêu đề khác</div> ';
            }
           
        }
        
    }
?>

<div class="container p-2 flex flex-row mx-auto">
    <div class="container p-2 flex flex-row mx-auto  justify-center ">
    
    <form method="post">

    <?php
     
        // Lấy tất cả thông tin của sản phẩm từ query string
        echo '<div class="main w-[100%]">';
        echo ' <label for="name" class="text-[1.4rem] font-medium">Tiêu đề bài viết</label> <br> <textarea id="name" name="name" type="text" class="text-6xl font-semibold bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"cols="24" rows="4">'.$name .'</textarea>';
        echo '<div class="text-red-700">*'.$nameEr.'</div>';
        echo ' <div class="content">  ';
        echo $paper['dateRealease'];
        echo '<div class="text-[1.4rem] font-medium">Ngày đăng: </div> <input readonly="readonly" id="dateRelease" name="dateRelease" type="text" value="'.$dateRelease.'" class="text-gray-600 text-[1rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"> ';
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
        echo '<input id="image" name="image" type="text" value="'.$image.'" class="text-gray-600 text-[1rem] w-[40rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" > ';
        echo '<div class="text-red-700">*'.$imageEr.'</div>';
        echo ' <div  class="flex justify-center flex-col text-center items-center">';
        echo ' <div class="text-[1.4rem] font-medium">Hình ảnh hiển thị</div> ';
        echo '<img src="'.$image.'" alt="Picture" class="w-[24rem]">';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="text-[2rem] font-medium">Đặc điểm nổi bật</div>';
        echo '<textarea id="description" name="description" type="text" class="text-[1rem] bg-gray-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" cols="90" rows="16">'.$description.'</textarea>';;
        echo '<div class="text-red-700">*'.$descriptionEr.'</div>';
        echo '</div>';
        echo '</div>';
    
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
                        Thêm
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none" class=" ms-[1rem]">
                    <path d="M13.125 0V12.6021H0V21.0035H13.125V33.6056H21.875V21.0035H35V12.6021H21.875V0H13.125Z" fill="white"/>
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