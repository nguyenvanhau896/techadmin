<?php
    class Home extends Controller
    {
        public function index($name=''){
            // $user = $this->model('User');
            // $user->name = $name;
            // 'name' => $user->name
            // $product = $this->model('Product');
            // $ele1 = $product->getProduct();
            // $ele2 = $product->getCategory();
            
            $this->view('home/index', []);
        }
        public function private(){
            $user = $this->model('User');
            $info = $user->getUser();
            $this->view('home/private', [
                'name' => $info[0]['user_name'],
                'email' => $info[0]['email'],
                'firstname' => $info[0]['first_name'],
                'lastname' => $info[0]['last_name'], // Corrected key name
                'phone' => $info[0]['phone'],
                'avatar' => $info[0]['avatar']
            ]);
        }        
    }
    
?>