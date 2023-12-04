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
            case 'edit':
                $id = $_POST["id"];
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

                    $query_1 = "UPDATE `product` 
                                SET name = '$name', price = '$price', man_hinh = '$screen', updated_at = '$date', mo_ta = '$des', image = '$image', category='$category'
                                WHERE id = $id";
                    $query_product = $conn->query($query_1);
                    if ($query_product){
                        $query_2 = "UPDATE `phone`
                                    SET kieumanhinh = '$screenType', dungluong = '$storage'
                                    WHERE id = $id";
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

                    $query_1 = "UPDATE `product` 
                                SET name = '$name', price = '$price', man_hinh = '$screen', updated_at = '$date', mo_ta = '$des', image = '$image', category='$category'
                                WHERE id = $id";
                    $query_product = $conn->query($query_1);
                    if ($query_product){
                        $query_2 = "UPDATE `laptop`
                                    SET cpu = '$cpu', card = '$screenCard', pin = '$battery', khoiluong = '$weight'
                                    WHERE id = $id";
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

                    $query_1 = "UPDATE `product` 
                                SET name = '$name', price = '$price', man_hinh = '$screen', updated_at = '$date', mo_ta = '$des', image = '$image', category='$category'
                                WHERE id = $id";
                    $query_product = $conn->query($query_1);
                    if ($query_product){
                        $query_2 = "UPDATE `tablet`
                                    SET kieumanhinh = '$screenType', dungluong = '$storage', ketnoi = '$connect'
                                    WHERE id = $id";
                        $query_category = $conn->query($query_2);
                        if ($query_category) echo 200;
                        else echo 500;
                    }
                    else{
                        echo $conn->error;
                    }
                }

                break;
            case "delete":
                $id = $_POST["id"];
                $categoryQuery = "SELECT * FROM `product` WHERE id='$id'";
                if ($category = $conn->query($categoryQuery)){
                    $thisCategory = mysqli_fetch_assoc($category);
                    $thisCategory = strtolower($thisCategory["category"]);
                    $query_1 = "DELETE FROM `$thisCategory` WHERE id='$id'";
                    if ($deleteInCategory = $conn->query($query_1)){
                        $query_2 = "DELETE FROM `product` WHERE id='$id'";
                        if ($deleteProduct = $conn->query($query_2)) echo 200;
                        else echo 500;
                    }
                    else echo 500;
                }
                else echo 500;
                break;
            default:
                echo 500;
        }
    }
    $conn->close();
//    require_once '../app/component/close.php';
?>