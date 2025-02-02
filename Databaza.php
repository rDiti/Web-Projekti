<?php

class Database{
    private $host = "localhost";
    private $dataName = "regjistrimi";
    private $useri = "root";
    private $pass = "";
    private $conn;
    
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dataName, $this->useri, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Database connection failed: ". $e->getMessage();
        }
        return $this->conn;
    }
}
?>