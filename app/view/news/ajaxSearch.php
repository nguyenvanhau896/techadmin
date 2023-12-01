
<?php
// your_backend_script.php
                        $host = 'localhost';  // Nếu MySQL server chạy trên localhost
                        $dbname = 'techshop';
                        $username = 'root';   // Tên người dùng MySQL, thường là "root" cho localhost
                        $password = ''; 
                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        
                        // Thiết lập chế độ lỗi để báo cáo tất cả các lỗi
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$title = isset($_GET['title']) ? ($_GET['title']) : '1';
$lowerTitle = strtolower($title);
// Sử dụng truy vấn SQL với LIKE và LOWER()
$query1 = "SELECT * FROM paper WHERE LOWER(name) LIKE '%$lowerTitle%'";
$stmt1 = $conn->query($query1);
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
        echo '<a href="/techadmin/admin/deletePaper/index?id='.$paperItem['id'].'" class="absolute text-[1.2rem] bottom-2 right-[2rem] inline-flex items-center px-3 py-2  font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-[8.6rem] text-center flex flex-row justify-center">
                Xóa
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 70 80" fill="none" class="ms-2 w-[1rem] h-[1.6rem]">
                <path d="M29.831 0C24.362 0 19.8873 4.47465 19.8873 9.94366H9.94366C4.47465 9.94366 0 14.4183 0 19.8873H69.6056C69.6056 14.4183 65.1309 9.94366 59.6619 9.94366H49.7183C49.7183 4.47465 45.2436 0 39.7746 0H29.831ZM9.94366 29.831V77.66C9.94366 78.7538 10.7391 79.5492 11.833 79.5492H57.8721C58.9659 79.5492 59.7614 78.7538 59.7614 77.66V29.831H49.8177V64.6338C49.8177 67.418 47.6301 69.6056 44.8459 69.6056C42.0617 69.6056 39.8741 67.418 39.8741 64.6338V29.831H29.9304V64.6338C29.9304 67.418 27.7428 69.6056 24.9586 69.6056C22.1744 69.6056 19.9867 67.418 19.9867 64.6338V29.831H10.0431H9.94366Z" fill="white"/>
                </svg>
            </a>';
        echo '</div>';
        echo '</div>';
        
     }

?>
