<?php

class Publication{
    private $db;
    public function __construct(){
        $this->db = new Database;
        
    }

    public function getPublications(){
        $this->db->query('SELECT publications.*, 
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

}