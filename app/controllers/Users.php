<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function register(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // die('Reached after form submission');
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Init data
        $data =[
          
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'city' => trim($_POST['city']),
          'name_err' => '',
          'email_err' => '',
          'city_err'=>'',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate CITY
        if(empty($data['city'])){
            $data['city_err'] = 'Pleae enter city';
          }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['city_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          // die('before upld');
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // die('inside upld 1');  
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

                // die('inside upld 1');
              if (in_array($_FILES['image']['type'], $allowedTypes)) {
                // die('inside upld 1');
                  $imagePath = $this->uploadImage($_FILES['image']);
                  $data['image'] = $imagePath;

                  // Register User
                  if($this->userModel->register($data)){
                    // die('inside upld 2');
                    redirect('users/login');
                  } else {
                    // die('Something went wrong');
                    echo "err" . $data['error'];
                    // die('inside upld 3');
                  }
              } else {
                  // Handle invalid file type
                  $data['image_err'] = 'Invalid file type. Please upload a JPEG, PNG, or GIF image.';
              }
          } else {
              // Handle file upload error
              $data['image_err'] = 'File upload error.';
          }
    
        } else {
          // Load view with errors
          $this->view('users/register', $data);
          
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'city'=> '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'city_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
        
      }
    }

    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      $_SESSION['user_city'] = $user->city;
      $_SESSION['user_img'] = $user->imgUrl;
      redirect('publications/');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_city']);
      session_destroy();
      redirect('users/login');
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
  }