<?php

session_start();
include "login.html";

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
            die("ke gabu diqka: " . $this->db->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                return ["success" => true, "user" => $user];
            } else {
                return ["success" => false, "message" => "Password eshte i pasakte."];
            }
        } else {
            return ["success" => false, "message" => "User nuk egziston."];
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
        $userData = $response['user'];
        
        var_dump($userData); 
        if ($userData['isadmin'] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: homepage1.html");
        }
        exit;
    } else {
        echo $response['message'];
    }
}

ob_start(); // Aktivizo output buffering
session_start();
include "login.html";

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
                return ["success" => false, "message" => "Password eshte i pasakte."];
            }
        } else {
            return ["success" => false, "message" => "User nuk egziston."];
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
        $userData = $response['user'];
        
        var_dump($userData); 
        if ($userData['isadmin'] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: homepage1.html");
        }
        exit;
    } else {
        echo $response['message'];
    }
}

?>

?>
