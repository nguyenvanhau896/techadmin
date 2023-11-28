<?php 
class Login extends Controller{
    public function index($name=''){
        // $user = $this->model('User');
        // $user->name = $name;
        
        $this->view('login/index', []);
    }
    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['name'];
            $pass = $_POST['password'];

            // Validate and sanitize input
            // ...
            echo $user. ' - '. $pass;
            $userModel = $this->model('User');
            $userModel->login($user, $pass);
        }else{
            echo "don't post";
        }
        if(isset($_SESSION['login']) && $_SESSION['login']){
            header('location: /techshop');
            exit();
        }else{
            echo "false connect";
        }
    }
    public function logout(){
        session_unset();
        session_destroy();
        $_SESSION = array();
        //
        header('location: /techshop');
        exit();
    }
}
?>