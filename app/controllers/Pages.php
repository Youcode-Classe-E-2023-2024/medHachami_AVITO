<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'title' => 'Home',
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Uss'
      ];

      $this->view('pages/about', $data);
    }
    public function test(){
      $data = [
        'title' => 'test'
      ];

      $this->view('pages/test', $data);
    }
  }
  ?>