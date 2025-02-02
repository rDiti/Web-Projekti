<?php

include "Validimi.php"; 
require_once "Databaza.php";
require_once "User.php";
include_once "Util.php";

function pastrimiInputit($input){
    return htmlspecialchars(stripslashes(trim($input)));
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = pastrimiInputit($_POST['firstname']);
    $lastname = pastrimiInputit($_POST['lastname']);
    $phone = pastrimiInputit($_POST['phone']);
    $email = pastrimiInputit($_POST['email']);
    $password = pastrimiInputit($_POST['password']);
    $confirm_password = pastrimiInputit($_POST['confirm_password']);
    $role = $_POST['role'];

    $data = "firstname=$firstname&lastname=$lastname&phone=$phone&email=$email&role=$role";
    
    if(!Validimi::phone($phone)){
        echo "<p class='error-message'>Phone is invalid</p>";
    }else if(!Validimi::password($password)){
        echo "<p class='error-message'>Password is invalid</p>";
    }else if ($password !== $confirm_password) {
        header("Location: register.php?error=Confirm passwords do not match");
        exit();
    }
    else{
        $db = new Database();
        $conn = $db->connect();
        if(!$conn){
            die("Database connection failed!");
        }else{
            echo "The database connection was successful!<br>";
        }
        $user = new User($firstname, $lastname, $phone, $email, $password, $role);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $res = $user->register($conn, [$firstname, $lastname, $phone, $email, $hashed_password, $role]);
        if($res){
            echo "User successfully registered!";
            header("Location: login.php");
            exit();
        }else{
            echo "An error occurred during registration!";
        }
    }
}
?>