<?php
require_once "connect.php";

class Vleresimet {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->connect();
    }

    public function kaVleresuarProfen($student_id, $professor_id) {
        $query = "SELECT * FROM vleresimet WHERE user_id = :student_id AND prof_id = :professor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":professor_id", $professor_id);
        $stmt->execute();
        return $stmt->rowCount() > 0; 
    }

    public function vleresoProfen($student_id, $professor_id, $rating) {
        if ($this->kaVleresuarProfen($student_id, $professor_id)) {
            
            $update = $this->updateNotenProfes($student_id, $professor_id, $rating);
            return;
        }

        $query = "INSERT INTO vleresimet (user_id, prof_id, nota) VALUES (:student_id, :professor_id, :rating)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":professor_id", $professor_id);
        $stmt->bindParam(":rating", $rating);

        if ($stmt->execute()) {
            
        } else {
            return "Error submitting rating.";
        }
    }

    public function updateNotenProfes($student_id, $professor_id, $rating) {
       
        $query = "UPDATE  vleresimet SET user_id=:student_id, prof_id=:professor_id, nota=:rating";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":professor_id", $professor_id);
        $stmt->bindParam(":rating", $rating);

        if ($stmt->execute()) {
            return "Thank you for your rating!";
        } else {
            return "Error submitting rating.";
        }
    }


    public function mesatarjaEProfes($professor_id) {
        $query = "SELECT AVG(nota) as avg_rating FROM vleresimet WHERE prof_id = :professor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":professor_id", $professor_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return round($result['avg_rating'], 1);
    }
}
?>
