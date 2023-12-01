<?php 
class DeletePaper extends Controller{
    public function index($name=''){
        // $user = $this->model('User');
        // $user->name = $name;

        $this->view('paper/deletePaper/index', []);
    }
}