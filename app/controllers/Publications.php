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
      $users = $this->userModel->getUers($_SESSION['user_id']);
      $publications = $this->publicationModel->getPublications();
      foreach ($publications as $key => $publication) {
        $publications[$key]->diffTime = $this->getTimeDifference($publication->pub_created_at);
      }
      // $diffTime = $this->getTimeDifference($publications['']);
      $data = [
        'publications' => $publications,
        'users' => $users,
      ];

      $this->view('publications/index', $data);
    }

    public function add() {
      $data = [];
  
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

          $data = [
              'title' => trim($_POST['title']),
              'description' => trim($_POST['description']),
              'price' => trim($_POST['price']),
              'user_id' => $_SESSION['user_id'],
          ];
  
          if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
              $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  
              if (in_array($_FILES['image']['type'], $allowedTypes)) {
                  $imagePath = $this->uploadImage($_FILES['image']);
                  $data['image'] = $imagePath;
  
                  if ($this->publicationModel->addPub($data)) {
                      // Redirect on success
                      redirect('publications/add?action=added');
                      // echo "succes";
                  } else {
                      // Handle database error
                      $data['error'] = 'Failed to add publication.';
                  }
              } else {
                  // Handle invalid file type
                  $data['image_err'] = 'Invalid file type. Please upload a JPEG, PNG, or GIF image.';
              }
          } else {
              // Handle file upload error
              $data['image_err'] = 'File upload error.';
          }
      }
  
      // Load the view with data
      $this->view('publications/add', $data);
    }

    private function uploadImage($file) {
        $target_dir = APPROOT . "/../public/img/";
        $target_file = $target_dir . basename($file["name"]);
    
        // Ensure the directory exists, create it if not
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
    
        move_uploaded_file($file["tmp_name"], $target_file);
        return basename($file["name"]);
    }
  
    function getTimeDifference($createdAt) {
      // Convert the timestamp to a DateTime object
      $createdAtDateTime = new DateTime($createdAt);
      $currentDateTime = new DateTime();
  
      // Calculate the time difference
      $interval = $currentDateTime->diff($createdAtDateTime);
  
      // Get the total minutes and seconds
      $minutes = $interval->i;
      $seconds = $interval->s;
  
      if ($interval->h > 0 || $interval->days > 0) {
          // If hours or days are greater than 0, consider it as minutes
          $minutes += $interval->h * 60 + $interval->days * 24 * 60;
      }
  
      if ($minutes > 0) {
          return $minutes . " minutes ago";
      } else {
          return $seconds . " seconds ago";
      }
  }
    


}