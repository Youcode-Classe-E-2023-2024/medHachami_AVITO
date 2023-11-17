<?php

class Publication{
    private $db;
    public function __construct(){
        $this->db = new Database;
        
    }

    public function getPublications(){
        $this->db->query('SELECT publications.id as pub_id,
                             publications.imgUrl as pub_img,
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
    public function getMyPublications(){
        $this->db->query('SELECT
                     publications.id as pub_id,
                             publications.imgUrl as pub_img,
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
                      WHERE user_id = :user_id
                      ORDER BY publications.created_at DESC');
        $this->db->bind(':user_id', $_SESSION['user_id']);
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

    public function addLike($userId, $publicationId) {
        $this->db->query('SELECT * FROM likes WHERE user_id = :user_id AND publication_id = :publication_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':publication_id', $publicationId);
        
        $existingLike = $this->db->single();
        if(!$existingLike){
            $this->db->query('INSERT INTO likes (user_id, publication_id) VALUES (:user_id, :publication_id)');
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':publication_id', $publicationId);
            $this->db->execute();
            return 1;
        }else{
            $this->db->query('DELETE FROM likes WHERE user_id = :user_id AND publication_id = :publication_id');
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':publication_id', $publicationId);
        
            $this->db->execute();
            return 0;
        }
    
        
    }
    // public function dislike($userId, $publicationId) {
       
    // }


    public function hasLiked($publicationId,$userId) {
        $this->db->query('SELECT * FROM likes WHERE user_id = :user_id AND publication_id = :publication_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':publication_id', $publicationId);
    
        $results = $this->db->resultSet();
        
    
        $result = count($results) > 0;
        
    
        return $result;
    }

}