<?php

class Publication{
    private $db;
    public function __construct(){
        $this->db = new Database;
        
    }

    public function getPublications(){
        $this->db->query('SELECT publications.imgUrl as pub_img,
                            publications.description as pub_description,
                            publications.created_at as pub_created_at, 
                             users.id as user_id,
                             users.name as user_name,
                             users.email as user_email,
                             users.city as user_city,
                             users.imgUrl as user_img
                      FROM publications
                      INNER JOIN users
                      ON publications.user_id = users.id
                      ORDER BY publications.created_at DESC');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addPub($data){
        $this->db->query('INSERT INTO publications (title, description, price, imgUrl, created_at, user_id) VALUES (:title, :description, :price, :imgUrl, :created_at, :user_id)');

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        
        
        $this->db->bind(':imgUrl', $data['image']);

        // Set the current time
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        $this->db->bind(':user_id', $data['user_id']);

        // Execute
        return $this->db->execute();
    }

}