<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO users (name, email, password,city,imgUrl) VALUES(:name, :email, :password, :city,:imgUrl)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':city', $data['city']);
      $this->db->bind(':imgUrl', $data['image']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    // Get User by ID
    public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getUers($id){
      $this->db->query('SELECT * FROM users where id <>:id LIMIT 5;');
      // Bind value
      $this->db->bind(':id', $id);
      $results = $this->db->resultSet();

      return $results;
  }

  }