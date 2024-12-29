<?php
$hostname = "localhost";
$username = "root";
$password = ""; 
$dbname = "test";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Homepage.css">
    <title>Homepage</title>
    <script>
        function hamburgerPop() {
            var x = document.getElementById("hamburger");
            var y = document.getElementById("LogIn_PopUp");
            
            
            if(y.style.display === "flex"){

            }else{
                if (x.style.display === "flex") {
                        x.style.display = "none";
                    
                    
                    } else {
                        x.style.display = "flex";
                        
                    }
            }
        }
        function LogInPop() {
            var x = document.getElementById("hamburger");
            var y = document.getElementById("LogIn_PopUp");
                
                y.style.display = "flex";
                x.style.display = "none";           
        }
       

        function LogInDown(){
            var y = document.getElementById("LogIn_PopUp");
            y.style.display = "none";
        }
        
        

        function LoggingIn(){
            

            const email = document.getElementById("e-mail").value.trim();
            const password = document.getElementById("password").value.trim();
            event.preventDefault();
            if (!email || !password) {
                alert("Please fill out all required fields.");
                
            }else{
                var y = document.getElementById("LogIn_PopUp");
                y.style.display = "none";
                var MyAcc = document.getElementById("LogIn/MyAcc");
                var logOut = document.getElementById("LogOut");

                MyAcc.textContent = "My Account";
                logOut.textContent = "Log Out"
                logOut.style.pointerEvents = "visible";
                MyAcc.style.pointerEvents = "none";
                alert("You have been logged in.");
            }
        }
        
          
        function LogOut(){
            alert("You have been logged out.");
            var x = document.getElementById("hamburger");
                x.style.display = "none";     
            var MyAcc = document.getElementById("LogIn/MyAcc");
            var logOut = document.getElementById("LogOut");

                MyAcc.textContent = "Log In";
                logOut.textContent = ""
                logOut.style.pointerEvents = "none";
                MyAcc.style.pointerEvents = "visible";     

        }
      

    </script>
</head>
<body>
    
    <div id="LogIn_PopUp">
        
        
        <form action="#">
            <input type="email" name="e-mail" id="e-mail" placeholder="Email..." required>
        
            <input type="password" name="pasword" id="password" placeholder="Password..." required> 
            
            <input type="submit" value="Log In"class="logInBtn" id="logInBtn"  onclick="LoggingIn()">
        </form>
        
            <a href="Detyra1.html">Forgot Password?</a>
            <p>Don't have an account?</p>
            <a href="Detyra2.html">Sign Up!</a> 
        
            
            <img src="close.png" alt="closebtn" onclick="LogInDown()">
        
       
        
    </div>

    <div class="navbar">
        <a href="Homepage.html" class="Logo">
            <img src="logo_transparent.png" alt="Logo" class="Logo">       
        </a>
        <input type="search" class="Search" placeholder="🔍Search">
       
            <img src="hamburger.png" alt="Hamburger" class="Hamburger-Img" onclick="hamburgerPop()">
              
    </div>
    
    <div id="hamburger">            
        <a href="#" onclick="LogInPop()" id="LogIn/MyAcc">Log In</a>
        <a href="abtus.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="#" class="LogOut" id="LogOut" onclick="LogOut()"></a>
    </div>
   <br><br><br>
    <div  class="container">
        
        <div class="Darker-kurs">
            <img src="profile.png" alt="foto">
            <p class="e">emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        
        <div class="Lighter-kurs">
            <img src="profile.png" alt="foto">
            <p>emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        <div class="Darker-kurs">
            <img src="profile.png" alt="foto">
            <p class="e">emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingsHalf_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        
        <div class="Lighter-kurs">
            <img src="profile.png" alt="foto">
            <p>emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingsHalf_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        <div class="Darker-kurs">
            <img src="profile.png" alt="foto">
            <p class="e">emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingsHalf_transparent.png" alt="ratings?">
            </div>    
        </div>
        <hr>
        
        <div class="Lighter-kurs">
            <img src="profile.png" alt="foto">
            <p>emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        <div class="Darker-kurs">
            <img src="profile.png" alt="foto">
            <p class="e">emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingsHalf_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        
        <div class="Lighter-kurs">
            <img src="profile.png" alt="foto">
            <p>emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingGood_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        <div class="Darker-kurs">
            <img src="profile.png" alt="foto">
            <p class="e">emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingsHalf_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
            </div>
        </div>
        <hr>
        
        <div class="Lighter-kurs">
            <img src="profile.png" alt="foto">
            <p>emri profes</p>
            <p>lenda</p>
            <p>nr tel</p>
            <div>
                <img src="ratingBad_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
                <img src="ratingBad_transparent.png" alt="ratings?">
            </div>
        </div>
     


    </div>
 
</body>
</html>