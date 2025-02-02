<?php

include "User.php";
require_once "Signup.php";

$errors = [];

if (isset($_POST['register_btn'])){
    $db = new Database();
    $conn = $db->connect();
    $user = new User($_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['role']);
    $errors = $user->register($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
<?php
if(is_array($errors) && count($errors) > 0){
  echo "<ul>";
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo "</ul>";
}
?>
<header>
  <a href="login.php">
    <img src="logo.png" alt="logo" class="Logo">
  </a>
  <?php
  if(isset($_GET['error'])){
    echo '<div class="error-message" id="popup-message">'.htmlspecialchars($_GET['error']).'</div>';
  }
  if (isset($_GET['success'])) {
    echo '<div class="success-message" id="popup-message">'.htmlspecialchars($_GET['success']).'</div>';
  }
  ?>
<script>
  setTimeout(function(){
      var message = document.getElementById("popup-message");
      if (message) {
          message.style.display = "none";
      }
  }, 3000);
</script>
<h1>Register</h1>
</header>
  <div id="register" class="klasa1">
    <form method="POST" action="" id="registerForm">
      <input type="text" name="firstname" placeholder="First Name..." id="firstname" required>
      <input type="text" name="lastname" placeholder="Last Name..." id="lastname" required>
      <input type="tel" name="phone" placeholder="Phone Number..." id="phone" required>
      <input type="email" name="email" placeholder="Email..." id="email" required>
      <input type="password" name="password" placeholder="Password..." id="password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password..." id="confirm_password" required>
      <div class="form-klasa2">
        <p>What are your intentions?</p>
        <label>
          <input type="radio" name="role" value="student" id="student" required> Pursue courses?
        </label>
        <label>
          <input type="radio" name="role" value="teach" id="professor" required> Teach courses?
        </label>
      </div>
      <div class="form-klasa3">
        <button type="submit" name="register_btn">Sign Up</button>
      </div> 
      <a href="login.php">Login Here</a>
    </form>
  </div>
</body>
</html>