<?php
    include_once 'connect.php';
    include_once "session.php";

    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    } else {
        echo "User not logged in!";
    }

 class Kursi{
    
    private $conn;
    
    
    public function __construct() {
        $database = new DatabaseConnection();
        $this->conn = $database->connect();
        
    }

    public function countKursProf($user_id) {
        $query = "SELECT COUNT(*) AS course_count FROM kurset WHERE prof_id = :user_id";
        $stmt = $this->conn->prepare($query);
       $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['course_count'] ?? 0;
    }

    public function krijoKursin($lenda, $pershkrimi){
        try{
            if ($this->countKursProf(3) >= 4) {
                echo "<script type='text/javascript'>
                            alert('❌ You have reached the course limit (4).');
                    </script>";
            }



            
                $query = "INSERT INTO kurset (prof_id, lenda, pershkrimi_kursit) VALUES (:user, :lenda, :pershkrimi)";
                $stmt = $this->conn->prepare($query);

             
             $stmt->bindParam(':user',$user_id);
             $stmt->bindParam(':lenda',$lenda);
             $stmt->bindParam(':pershkrimi',$pershkrimi);
             
             if($stmt->execute()){
                
             }
             else{
                return "failed to add kurs";
             }

        }catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
   
        

    }

    public function getAllKurse(){
        $query = "SELECT * FROM kurset";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKursiById($id) {
        $query = "SELECT * FROM kurset WHERE kurs_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countKursStudent($user_id) {
        $query = "SELECT COUNT(*) AS std_count FROM ndjekja_kursit WHERE student_id = :user_id";
        $stmt = $this->conn->prepare($query);
       $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['std_count'] ?? 0;
    }

    
    public function ndjek_Kursin($student_id, $kurs_id) {
        $query = "SELECT * FROM ndjekja_kursit WHERE student_id = :student_id AND kurs_id = :kurs_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id',$student_id);
        $stmt->bindParam(':kurs_id',$kurs_id);
        $stmt->execute();
        return $stmt->rowCount() > 0; 
    }

    public function enrollToKursById($kurs_id,$student_id){
        try{
           
            if ($this->countKursStudent(13) >= 4) {
                echo "<script type='text/javascript'>
                            alert('❌ You have reached the course limit (4).');
                    </script>";
            }

                $query = "INSERT INTO ndjekja_kursit (student_id, kurs_id) VALUES (:student_id, :kurs_id)";
                $stmt = $this->conn->prepare($query);
                       
                $stmt->bindParam(':student_id',$student_id);
                $stmt->bindParam(':kurs_id',$kurs_id);                         
             if($stmt->execute()){
                
             }
             else{
                return "failed to add kurs";
             }

        }catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function unenrollKursStudent($kurs_id,$student_id) {
        $query = "DELETE FROM ndjekja_kursit WHERE student_id = :student_id AND kurs_id = :kurs_id";
        $stmt = $this->conn->prepare($query);
                       
        $stmt->bindParam(':student_id',$student_id);
        $stmt->bindParam(':kurs_id',$kurs_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;

        
    }

}    









?>