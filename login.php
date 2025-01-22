<?php
include"login.html";
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "login/userat"; 
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

class User {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM loginuserat WHERE email = ?";
        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $this->db->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

           
            if (password_verify($password, $user['password'])) {
                return ["success" => true, "user" => $user];
            } else {
                return ["success" => false, "message" => "Password is incorrect."];
            }
        } else {
            return ["success" => false, "message" => "User not found."];
        }
    }
}


$database = new Database();
$dbConnection = $database->connect();


$user = new User($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $response = $user->login($email, $password);
    if ($response['success']) {
       
        echo "Welcome, " . $response['user']['firstname'] . " " . $response['user']['lastname'] . "!";
        
      
        sleep(2);
        
       
        header("Location: homepage1.html");
        exit; 
    } else {
        echo "Login failed. Please try again.";
    }
    
}
?>

