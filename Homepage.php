<?php
include_once "session.php";
include_once "Profile.php";
include_once "Kursi.php";
include_once "Vleresimet.php";


if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    echo "User not logged in!";
}


$database = new DatabaseConnection();
$db = $database->connect();


$kursi = new Kursi($db);
$user = new Profile($db);
$rating = new Vleresimet($database);


$useriSpecifik = $user->getUserById(3);
$professor_id = $useriSpecifik["id"];
$mesatarjaVleresimit = $rating->mesatarjaEProfes($professor_id);
$allKurset = $kursi->getAllKurse();
$count=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST["search"]);
    $searchResults = $kursi->searchCourses($searchTerm);
}
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
        <a href="Homepage.html" class="Logo">
            <img src="logo_transparent.png" alt="Logo" class="Logo">       
        </a>
        <form action="" class="search" method="post">
             <input type="text" name="search" class="Search" placeholder="🔍Search">
        </form> 
       
       
            <img src="hamburger.png" alt="Hamburger" class="Hamburger-Img" onclick="hamburgerPop()">
              
    </div>
    
    <div id="hamburger">            
        <a href="MyProfile.php" >My Profile</a>
        <a href="abtus.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="login.php" id="LogOut"  onclick="LogOut()">Log Out</a>
      
       
    </div>
   <br><br><br>
   <div class="container">
   
             <?php foreach ($allKurset as $kurset): ?>
                <?php $count++; ?>
                <div class="kurs" style="background-color: <?php echo ($count % 2 == 0) ? 'rgb(122, 178, 211);' : 'rgb(223, 242, 235);'; ?>;">
                    <img src="<?php echo htmlspecialchars($useriSpecifik['image_path']); ?>" alt="profil">
                    <p><?php echo htmlspecialchars($useriSpecifik['Emri']);?> <?php echo htmlspecialchars($useriSpecifik['Mbiemri'])?> </p>
                    <p><?php echo htmlspecialchars($kurset['lenda']);?></p>
                    <p><?php echo htmlspecialchars($useriSpecifik['Nr_tel']);?></p>

                    <?php if($mesatarjaVleresimit == 0): ?>
                        <img src="vleresimi0.png" alt="ratings?" class="ratings">

                        <?php elseif($mesatarjaVleresimit>0 && $mesatarjaVleresimit<=0.5):?>
                            <img src="vleresimi0.5.png" alt="ratings?" class="ratings">

                        <?php elseif($mesatarjaVleresimit>0.5 && $mesatarjaVleresimit<=1):?>
                            <img src="vleresimi1.png" alt="ratings?" class="ratings">

                        <?php elseif($mesatarjaVleresimit>0.5 && $mesatarjaVleresimit<=1):?>
                            <img src="vleresimi1.png" alt="ratings?" class="ratings">

                        <?php elseif($mesatarjaVleresimit>1 && $mesatarjaVleresimit<=1.5):?>
                            <img src="vleresimi1.5.png" alt="ratings?" class="ratings">

                        <?php elseif($mesatarjaVleresimit>1.5 && $mesatarjaVleresimit<=2):?>
                            <img src="vleresimi2.png" alt="ratings?" class="ratings">

                        <?php elseif($mesatarjaVleresimit>2 && $mesatarjaVleresimit<=2.5):?>
                            <img src="vleresimi2.5.png" alt="ratings?" class="ratings">
                        <?php else:?>
                            <img src="vleresimi3.png" alt="ratings?" class="ratings"> 
                            
                    <?php endif?>        
                    <a href="infoKurs.php?kurs_id=<?php echo $kurset['kurs_id']; ?>">VIEW</a>
                </div>
                    <hr>
            <?php endforeach; ?>
        
    </div>    
 
</body>
</html>