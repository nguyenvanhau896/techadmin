<?php 
class AddPaper extends Controller{
    public function index($name=''){
        // $user = $this->model('User');
        // $user->name = $name;

        $this->view('paper/addPaper/index', []);
    }
}