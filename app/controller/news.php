<?php
    class News extends Controller
    {
        public function index($name=''){
            $this->view('news/index', []);
        }
    }
    
?>