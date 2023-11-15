<?php
  class Publications extends Controller {

    public function __construct(){
       
        $this->publicationModel = $this->model('Publication');
    }

    public function index(){
      
      $data = [
        'title' => 'publications',
      ];

      $this->view('publications/index', $data);
    }

    


}