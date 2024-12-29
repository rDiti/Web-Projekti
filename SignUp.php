<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="Detyra2.css">

    <script>
      function SignUp(){
            
            
            const name = document.getElementById("name").value.trim();
            const lastname = document.getElementById("lastname").value.trim();
            const tele = document.getElementById("tele").value.trim();
            const email = document.getElementById("email").value.trim();
            const pass = document.getElementById("pass").value.trim();
            const conPass = document.getElementById("conPass").value.trim();
            const std = document.getElementById("std").checked;
            const prof = document.getElementById("prof").checked;
            
            
            if (!name || !lastname|| !tele || !email || !pass || !conPass || (!std && !prof)) {
                alert("Please fill out all required fields.");
                
            }else{
              alert("Your account has been created. Proceed to homepage to log in.");

            }
        }


    </script>
</head>
<body>
  <header>
    <a href="Homepage.html">
      <img src="logo_transparent.png" alt="logo" class="Logo">
    </a>
    <h1>Register</h1>
  </header>
  <div id="register" class="klasa1">
    <form>
      <input type="text" placeholder="Name..." id="name" required>
      <input type="text" placeholder="Last Name..." id="lastname" required>
      <input type="tel" placeholder="Phone Number..." id="tele" required>
      <input type="email" placeholder="Email..." id="email" required>
      <input type="password" placeholder="Password..." id="pass" required>
      <input type="password" placeholder="Confirm Password..." id="conPass" required>
      <div class="form-klasa2">
        <p>What are your intentions?</p>
        <label>
          <input type="radio" name="role" value="student" id="std" required> Pursue courses?
        </label>
        <label>
          <input type="radio" name="role" value="teach" id="prof" required> Teach courses?
        </label>
      </div>
      <div class="form-klasa3">
        <button type="submit" onclick="SignUp()">Sign Up</button>
      </div>
      
    </form>
  </div>
</body>
</html>