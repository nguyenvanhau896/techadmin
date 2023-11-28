<?php
    class Api extends Controller
    {
        public function name(){
            $user = $this->model('User');
            $info = $user->getUser();
            echo $info[0]['user_name'];
        }
    }
?>