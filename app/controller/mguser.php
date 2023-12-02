<?php
    class Mguser extends Controller
    {
        public function index($name = ''){
            $this->view('mguser/index', []);
        }
        public function deleteuser(){
            require_once '../app/component/checkAdminLogin.php';
            if(isset($_POST['user_id'])){
                echo $_POST['user_id'];
                $user = $this->model('User');
                $user->deleteUser($_POST['user_id']);
            }else{
                echo 'Nothing in there!';
            }
        }
        public function edit(){
            require_once '../app/component/checkAdminLogin.php';
            if(isset($_POST['user_id'])){
                $user = $this->model('User');
                $data = $user->getUserIdx($_POST['user_id']);
                $email = $data[0]['email'];
                $fname = $data[0]['first_name'];
                $lname = $data[0]['last_name'];
                $phone = $data[0]['phone'];
                $pass = $data[0]['password'];
                $name = $data[0]['user_name'];
                $avatar = $data[0]['avatar'];
                $this->view('mguser/edit', [
                    'password' => $pass,
                    'email' => $email,
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'phone' => $phone,
                    'name' => $name,
                    'avatar' => $avatar
                ]);
            }   
        }
        public function changeinfo(){
            require_once '../app/component/checkAdminLogin.php';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(!isset($_POST['email']) || !isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['phone']) || !isset($_POST['password'])){
                    echo 'wrong! you need provide full field.';
                }else{
                    $email = $_POST['email'];
                    $fname = $_POST['firstname'];
                    $lname = $_POST['lastname'];
                    $phone = $_POST['phone'];
                    $pass = $_POST['password'];
                    $id = $_POST['id'];
                    $user = $this->model('User');
                    $user->updateUser([
                        'password' => $pass,
                        'email' => $email,
                        'fname' => $fname,
                        'lname' => $lname,
                        'phone' => $phone,
                        'id' => $id
                    ]);
                    header('location: /techadmin/admin/mguser/index');
                    exit();
                }
            }
        }
        public function add(){
                $this->view('mguser/add', []);
        }
        public function register(){
            require_once '../app/component/checkAdminLogin.php';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $uname = $_POST['uname'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $userpass = $_POST['password'];
                $email = $_POST['email'];
                echo $uname . $fname . $lname . $userpass . $email;
                $usr = $this->model('User');
                $usr->register([
                        'password' => $userpass,
                        'email' => $email,
                        'fname' => $fname,
                        'lname' => $lname,
                        'uname' => $uname
                ]);
                header('location: /techadmin/admin/mguser/index');
                exit();
            }
        }
    }
    
?>