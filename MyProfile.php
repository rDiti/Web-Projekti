
<?php
include_once "session.php";

include_once "Profile.php";
include_once "Kursi.php";


if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    echo "User not logged in!";
}
$database = new DatabaseConnection();
$db = $database->connect();
$kursi = new Kursi($db);
$user = new Profile($db);

$useriSpecifik = $user->getUserById($user_id);
$allKurset = $kursi->getAllKurse();
$count=0;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MyProfile.css">
    <title>My Profile</title>
    <script>
        function hamburgerPop() {
            var x = document.getElementById("hamburger");
           
            
    
                if (x.style.display === "flex") {
                        x.style.display = "none";
                    
                    
                    } else {
                        x.style.display = "flex";
                        
                    }
        }
       
          
        function LogOut(){
            alert("You have been logged out.");
              

        }
       
      

    </script>
</head>
<body>

    
    

    <div class="navbar">
       
        <img src="<?php echo htmlspecialchars($useriSpecifik['image_path']); ?>" alt="FotoProfili" class="profili" id="profili">       
        <p id="Emri_Mbiemri"><?php echo htmlspecialchars($useriSpecifik['Emri']);?> <?php echo htmlspecialchars($useriSpecifik['Mbiemri'])?></p>
        <p class="phone" id="phone"><?php echo htmlspecialchars($useriSpecifik['Nr_tel']);?> </p>
        <p class="ratings" id="ratings">Vleresimi juaj: <?php echo htmlspecialchars($useriSpecifik['vleresimi']?? 'null');?></p>
        <img src="hamburger.png" alt="Hamburger" class="Hamburger-Img" onclick="hamburgerPop()">
              
    </div>
    
    <div id="hamburger">            
        <a href="Homepage.php">Homepage</a>
        <a href="abtus.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="#"  id="LogOut" onclick="LogOut()">Log Out</a>
    </div>
   <br><br><br>
        <div  class="container">
        
            <p class="pershkrimi personal"><?php echo htmlspecialchars($useriSpecifik['pershkrimi']);?> </p>
        </div>  
        <div class="buttonat">
            <a href="MyCourses.php"><button class="Courses">Kurset e mia</button></a>
            <a href="EditProfile.php"><button class="edit">Editoni profilin</button></a>
            
        </div>

    
 
</body>
</html>