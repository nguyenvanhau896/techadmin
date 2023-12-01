<?php 
class EditPaper extends Controller{
    public function index($name=''){
        // $user = $this->model('User');
        // $user->name = $name;

        $this->view('paper/editPaper/index', []);
    }
}