<?php
    class User{
        public $name; 
        public function login($user, $pass){
            require_once('../app/component/connect.php'); //connect database
            $ressult = '';
            try{
            $stmt = $conn->prepare('SELECT * FROM Admin WHERE name = :username and password = :password');
            $stmt->bindParam(":username", $user);
            $stmt->bindParam(":password", $pass);
            $stmt->execute();
            if($stmt->rowCount() > 0){
               $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               $_SESSION['admin'] = true;  
               $_SESSION['admin_id'] = $result[0]['admin_id'];
            }else{
                header('location: /techadmin/admin/login/index');
                echo "false";
                exit();
            }
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            require_once('../app/component/close.php');
            return $result;
        }
        // public function getUser(){
        //     require_once('../app/component/connect.php'); //connect database
        //     $ressult = '';
        //     try{
        //     $stmt = $conn->prepare('SELECT * FROM User WHERE user_id = ' . $_SESSION['user_id']);
        //     $stmt->execute();

        //     if($stmt->rowCount() > 0){
        //        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     }else{
        //         header('location: /techshop_admin/admin/login/index');
        //         echo "false";
        //         exit();
        //     }
        //     }catch(PDOException $e){
        //         echo "Error: " . $e->getMessage();
        //     }
        //     require_once('../app/component/close.php');
        //     return $result;
        // }
    }
?>