<?php
    class Mguser extends Controller
    {
        public function index($name=''){
            $this->view('mguser/index', []);
        }
    }
    
?>