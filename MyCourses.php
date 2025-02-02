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
$database1 = new DatabaseConnection();
$db1 = $database->connect();

$kursi = new Kursi($db);
$user = new Profile($db);

$useriSpecifik = $user->getUserById($user_id);
$allKurset = $kursi->getKursiById($user_id);
$count=0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MyCourses.css">
    <title>My Courses</title>
    <script>
    
       
      

    </script>
</head>
<body>

    
    

    <div class="navbar">
       
              
        <p id="Emri_Mbiemri"><?php echo htmlspecialchars($useriSpecifik['Emri']);?> <?php echo htmlspecialchars($useriSpecifik['Mbiemri'])?></p>
       
        <a href="MyProfile.php" class="Close-Img"><img src="close.png" alt="closebtn" class="Close-Img"></a>      
    </div>
    
    <div id="hamburger">            
        <a href="Homepage.php">Homepage</a>
        <a href="abtus.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="#"  id="LogOut" onclick="LogOut()">Log Out</a>
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
                <a href="TESTINGsingle.php?kurs_id=<?php echo $kurset['kurs_id']; ?>">VIEW</a>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>       
        

    
       
            
            

    
 
</body>
</html>