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
        public function getusr(){
            require_once('../app/component/connect.php'); //connect database
            $ressult = '';
            try{
            $stmt = $conn->prepare('SELECT * FROM User');
            $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            require_once('../app/component/close.php');
            return $result;
        }
        public function deleteUser($idx){
            try{
                require_once '../app/component/connect.php';
                $sql = 'DELETE FROM User WHERE user_id = ' . (int)$idx;
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }finally{
                require_once '../app/component/close.php';
            }
        }
        public function getUserIdx($idx){
            $result = '';
            try{
                require_once '../app/component/connect.php';
                $sql = 'SELECT * FROM User WHERE user_id = ' . (int)$idx;
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo $e->getMessage();
            }finally{
                require_once '../app/component/close.php';
            }
            return $result;
        }
        public function updateUser($data = [])
        {
            require_once '../app/component/connect.php'; // connect
        
            try {
                // Use placeholders to prevent SQL injection
                $sql = 'UPDATE User SET password = :password, email = :email, first_name = :fname, last_name = :lname, phone = :phone WHERE user_id = :user_id';
        
                // Prepare the SQL statement
                $stmt = $conn->prepare($sql);
        
                // Bind parameters with values
                $stmt->bindParam(':password', $data['password']);
                $stmt->bindParam(':email', $data['email']);
                $stmt->bindParam(':fname', $data['fname']);
                $stmt->bindParam(':lname', $data['lname']);
                $stmt->bindParam(':phone', $data['phone']);
                $stmt->bindParam(':user_id', $data['id']);
        
                // Execute the statement
                $stmt->execute();
        
                // Redirect after successful update
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally { // if succes it go to this area!
                require_once '../app/component/close.php'; // close
            }
        }  
        public function register($data = []){
            require_once '../app/component/connect.php'; // connect
            print_r($data);
            try {
                // Use placeholders to prevent SQL injection
                $sql = 'INSERT INTO User (user_name, first_name, last_name, password, email) VALUES (:uname, :fname, :lname, :password, :email)';
        
                // Prepare the SQL statement
                $stmt = $conn->prepare($sql);
        
                // Bind parameters with values
                $stmt->bindParam(':password', $data['password']);
                $stmt->bindParam(':email', $data['email']);
                $stmt->bindParam(':fname', $data['fname']);
                $stmt->bindParam(':lname', $data['lname']);
                $stmt->bindParam(':uname', $data['uname']);
                // Execute the statement
                $stmt->execute();
        
                // Redirect after successful update
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally { // if succes it go to this area!
                require_once '../app/component/close.php'; // close
            }
        }      
    }
?>