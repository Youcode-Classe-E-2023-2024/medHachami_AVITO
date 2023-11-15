<?php
  class Publications extends Controller {

    public function __construct(){
       if(!isLoggedIn()){
        redirect('users/login');
          
       }
       $this->publicationModel = $this->model('Publication');
        $this->userModel = $this->model('User');
       
    }

    public function index(){
      $publications = $this->publicationModel->getPublications();
      $data = [
        'publications' => $publications
      ];

      $this->view('publications/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
      }
    }

    


}