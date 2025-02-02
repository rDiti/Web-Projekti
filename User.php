<?php

require_once "Databaza.php";

class User{
    private $firstname;
    private $lastname;
    private $phone;
    private $email;
    private $password;
    private $role;

    public function __construct($firstname, $lastname, $phone, $email, $password, $role){
        $this->firstname = trim($firstname);
        $this->lastname = trim($lastname);
        $this->phone = trim($phone);
        $this->email = trim($email);
        $this->password = $password;
        $this->role = $role;
    }
    public function register($db){
        if ($this->Validimi()){
            $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `users` (`firstname`, `lastname`, `phone`, `email`, `password`, `isadmin`, `isstudent`, `isprofessor`, `created_at`) VALUES (:firstname, :lastname, :phone, :email, :password, 0, " . ($this->role == 'student' ? 1 : 0) . ", " . ($this->role == 'teach' ? 1 : 0) . ", NOW())";
            try{
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':firstname', $this->firstname);
                $stmt->bindParam(':lastname', $this->lastname);
                $stmt->bindParam(':phone', $this->phone);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':password', $hashed_password);

                $stmt->execute();
                $_SESSION['user_email'] = $this->email;
                $_SESSION['is_logged_in'] = true;
                setcookie("user_email", $_SESSION['user_email'], time() + 3600, "/", "", true, true);
                setcookie("is_logged_in", $_SESSION['is_logged_in'], time() + 3600, "/", "", true, true);

                header("Location: login.php");
                exit();
            }catch (PDOException $e){
                return "Registration failed! Error: " . $e->getMessage();
            }
        }else{
            return "All data must be complete!";
        }
    }
    public function Validimi(){
        return !empty($this->firstname) && !empty($this->lastname) && !empty($this->phone) && !empty($this->email) && !empty($this->password) && filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->password) >= 8;
    }
}

?>