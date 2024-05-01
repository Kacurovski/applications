<?php

class Page extends DB 
{

    private $query = [
        'create' => 'INSERT INTO pages(cover_image_url, title, subtitle, description, telephone, location, content_type, content1_url, content1_description, content2_url, content2_description, content3_url, content3_description, contact_description, linkedin_url, facebook_url, twitter_url, google_plus_url) VALUES (:cover_image_url, :title, :subtitle, :description, :telephone, :location, :content_type, :content_one_url, :content_one_description, :content_two_url, :content_two_description, :content_three_url, :content_three_description, :contact_description,  :linkedin_url, :facebook_url , :twitter_url, :google_plus_url)',

        'read' => 'SELECT * FROM pages'
    ];


    public function __construct(){
        parent::__construct();
    }

    public function createPage(array $params){
        $pdo = $this->instance;
        
        $sql = $this->query['create'];

        $stmt = $pdo->prepare($sql);

        $stmt->execute($params);

        $lastInsertId = $pdo->lastInsertId();

        return $lastInsertId; 
    } 

    public function getAllPages(){
        $pdo = $this->instance;
       
        $sql = $this->query['read'];
        
        $stmt = $pdo->query($sql);
        
        return $stmt->fetchAll();
    }

    public function getSinglePage($id){
        $pdo = $this->instance;
        
        $sql = $this->query['read'] . ' WHERE id = :id LIMIT 1';
        
        $stmt = $pdo->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }
}