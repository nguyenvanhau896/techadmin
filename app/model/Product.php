<?php
    class Product {
        function getAllProduct() {
            require_once('../app/component/connect.php');
            $query = "SELECT * FROM `product`";

            if ($query_product = $conn->query($query)){
                $res = $query_product->fetchAll(PDO::FETCH_ASSOC);
            }
            require_once('../app/component/close.php');

            return $res;
        }
    }
?>