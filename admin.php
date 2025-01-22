<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("ke bo gabim diqka: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("error on database " . $this->conn->error);
        }
        return $result;
    }

    public function close() {
        $this->conn->close();
    }
}

class AdminStats {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function countStudents() {
        $sql = "SELECT COUNT(*) AS num_students FROM loginuserat WHERE isstudent = 1";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['num_students'];
    }

    public function countProfessors() {
        $sql = "SELECT COUNT(*) AS num_professors FROM loginuserat WHERE isprofessor = 1";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['num_professors'];
    }

    public function getStudents() {
        $sql = "SELECT firstname FROM loginuserat WHERE isstudent = 1";
        return $this->db->query($sql);
    }

    public function getProfessors() {
        $sql = "SELECT firstname FROM loginuserat WHERE isprofessor = 1";
        return $this->db->query($sql);
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login/userat";

$db = new Database($servername, $username, $password, $dbname);
$adminStats = new AdminStats($db);

$num_students = $adminStats->countStudents();
$num_professors = $adminStats->countProfessors();
$students = $adminStats->getStudents();
$professors = $adminStats->getProfessors();

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

</head>
<body>
    <div class="container">
        <h1>Admin Page</h1>
        <div class="stats">
            <div class="stat">
                <h2><?php echo $num_students; ?></h2>
                <p>Studentë</p>
            </div>
            <div class="stat">
                <h2><?php echo $num_professors; ?></h2>
                <p>Profesorë</p>
            </div>
        </div>
        <div class="list">
            <h3>Lista e Studentëve</h3>
            <ul>
                <?php if ($students->num_rows > 0): ?>
                    <?php while ($row = $students->fetch_assoc()): ?>
                        <li><?php echo $row['firstname']; ?></li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>Asnjë student i regjistruar.</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="list">
            <h3>Lista e Profesorëve</h3>
            <ul>
                <?php if ($professors->num_rows > 0): ?>
                    <?php while ($row = $professors->fetch_assoc()): ?>
                        <li><?php echo $row['firstname']; ?></li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>Asnjë profesor i regjistruar.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="navbar">
        <img src="cck.png" alt="Logo">
    </div>
    <style>

        .navbar{

            display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 50px;
    background-color: #355c7d;
    color: white;
    position: fixed; 
    top: 0; 
    width: 100%; 
    z-index: 1000; 
           


       
        
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .stat {
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color:rgb(150, 35, 35);
            width: 45%;
        }
        .stat h2 {
            color: #007bff;
            font-size: 2em;
            margin: 10px 0;
        }
        .stat p {
            color: #555;
        }
        .list {
            margin-top: 20px;
        }
        .list h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .list ul {
            list-style-type: none;
            padding: 0;
        }
        .list li {
            background: #f9f9f9;
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
</body>
</html>