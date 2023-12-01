<?php
//    require_once('../app/component/connect.php');
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database = "techshop";
                    
    $conn = mysqli_connect($server_name, $user_name, $password, $database);
    if (!$conn) {
        echo "Connection failed!";
    }
   if (isset($_POST['scope'])){
        $scope = $_POST['scope'];
        switch ($scope){
            case 'add':
                $name = $_POST["name"];
                $price = $_POST["price"];
                $screen = $_POST["screen"];
                $image = $_POST["image"];
                $des = $_POST["des"];
                $category = $_POST["category"];
                $date = date("Y/m/d");
                if ($category == "Phone"){
                    $screenType = $_POST["screenType"];
                    $storage = $_POST["storage"];

                    $query_1 = "INSERT INTO `product` (name, price, man_hinh, created_at, updated_at, mo_ta, image, category) 
                        VALUES ('$name', '$price', '$screen', '$date', '$date', '$des', '$image', '$category')";
                    $query_product = $conn->query($query_1);
                    if ($query_product){
                        $lastId = $conn->insert_id;
                        $query_2 = "INSERT INTO `phone` (id, kieumanhinh, dungluong) 
                            VALUES ('$lastId', '$screenType', '$storage')";
                        $query_category = $conn->query($query_2);
                        if ($query_category) echo 200;
                        else echo 500;
                    }
                    else{
                        echo 500;
                    }
                }elseif ($category == "Laptop"){
                    $cpu = $_POST["cpu"];
                    $screenCard = $_POST["screenCard"];
                    $battery = $_POST["battery"];
                    $weight = $_POST["weight"];

                    $query_1 = "INSERT INTO `product` (name, price, man_hinh, created_at, updated_at, mo_ta, image, category) 
                        VALUES ('$name', '$price', '$screen', '$date', '$date', '$des', '$image', '$category')";
                    $query_product = $conn->query($query_1);
                    if ($query_product){
                        $lastId = $conn->insert_id;
                        $query_2 = "INSERT INTO `laptop` (id, cpu, card, pin, khoiluong) 
                            VALUES ('$lastId', '$cpu', '$screenCard', '$battery', '$weight')";
                        $query_category = $conn->query($query_2);
                        if ($query_category) echo 200;
                        else echo 500;
                    }
                    else{
                        echo 500;
                    }
                }elseif ($category == "Tablet"){
                    $screenType = $_POST["screenType"];
                    $storage = $_POST["storage"];
                    $connect = $_POST["connect"];

                    $query_1 = "INSERT INTO `product` (name, price, man_hinh, created_at, updated_at, mo_ta, image, category) 
                        VALUES ('$name', '$price', '$screen', '$date', '$date', '$des', '$image', '$category')";
                    $query_product = $conn->query($query_1);
                    if ($query_product){
                        $lastId = $conn->insert_id;
                        $query_2 = "INSERT INTO `tablet` (id, kieumanhinh, dungluong, ketnoi) 
                            VALUES ('$lastId', '$screenType', '$storage', '$connect')";
                        $query_category = $conn->query($query_2);
                        if ($query_category) echo 200;
                        else echo 500;
                    }
                    else{
                        echo 500;
                    }
                }

                break;
            // case 'edit':
            //     $prod_id = $_POST['prod_id'];

            //     $query = "SELECT * FROM `cart` WHERE productID='$prod_id'";
            //     $query_product = $conn->query($query);

            //     if (mysqli_num_rows($query_product) > 0){
            //         $delete_query = "DELETE FROM cart WHERE productID = '$prod_id'";
            //         $delete_query_run = $conn->query($delete_query);
            //         if ($delete_query_run) echo 200;
            //         else echo 500;
            //     }
            //     else{
            //         echo "something went wrong";
            //     }
            default:
                echo 500;
        }
    }
    $conn->close();
//    require_once '../app/component/close.php';
?>