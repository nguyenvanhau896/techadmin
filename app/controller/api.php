<?php require_once '../app/component/checkAdminLogin.php';?>
<?php
    class Api extends Controller
    {
        public function name(){
            $user = $this->model('User');
            $info = $user->getUser();
            echo $info[0]['user_name'];
        }
        public function getusr(){
            $user = $this->model('User');
            $data = $user->getusr();
            echo json_encode($data);
        }
    }
?>