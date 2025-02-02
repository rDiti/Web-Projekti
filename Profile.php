<?php

include "connect.php";




 class Profile{
    private $conn;
    private $uploadDir = "uploads/";
    
    public function __construct() {
        $database = new DatabaseConnection();
        $this->conn = $database->connect();
        
    
    }


    
    public function getUserById($id) {
        $query = "SELECT * FROM user WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function editProfile($id,$imageFile, $nrTel, $pershkrimi){
      
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true); // Create folder if not exists
        }
  
        $imageName = basename($imageFile['name']);
        $imagePath = $this->uploadDir . $imageName;
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedTypes)) {
            return "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
        if (move_uploaded_file($imageFile['tmp_name'], $imagePath)) {
               $query = "UPDATE user SET image_name = :imageName, image_path = :imagePath, Nr_tel = :NrTel, pershkrimi = :pershkrimi WHERE id = :id";
                $stmt = $this->conn->prepare($query);
        
                $stmt->bindParam(':id',$id);
                $stmt->bindParam(':imageName',$imageName);
                $stmt->bindParam(':imagePath',$imagePath);
                $stmt->bindParam(':NrTel',$nrTel);
                $stmt->bindParam(':pershkrimi',$pershkrimi);
           
            return $stmt->execute() ? 'true' : 'false';
        } else {
            return 'Error: File upload failed';
        }
           
            
     }
        
    



}