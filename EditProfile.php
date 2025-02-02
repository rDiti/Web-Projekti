<?php 
    include_once "session.php";
    include "Profile.php";
   
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    } else {
        echo "User not logged in!";
    }  
    $database = new DatabaseConnection();   
    $user = new Profile($database);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
            $userId = $user_id;         
            $img = $_FILES['image'];       
            $NrTel = $_POST['phone']; 
            $pershkrimi = $_POST['pershkrimi']; 
   
         $user->editProfile($userId, $img, $NrTel, $pershkrimi);
       
    
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="EditProfile.css">
    <title>Edit Profile</title>
    <script>

    </script>
</head>
<body>


    <div class="navbar">     
        <a href="MyProfile.php" class="Close-Img"><img src="close.png" alt="closebtn" class="Close-Img"></a>             
    </div>
  
   <br><br><br>

        <div  class="container">
            <form action="" method="post" enctype="multipart/form-data">
                    <label for="image">Ndryshoni foton tuaj: </label>
                    <input type="file" name="image" id="image" accept="image/*">

                    <label for="phone">Ndryshoni numrin tuaj: </label>
                    <input type="tel" placeholder="Nr. tel" pattern="[0-9]{9}" name="phone" id="phone">
                    
                    <label for="pershkrimi">Ndryshoni pershkrimin tuaj: </label>
                    <textarea name="pershkrimi" id="pershkrimi" rows="6" cols="100" maxlength="500" placeholder="(500 karaktere maximumi)"></textarea>    

            <button type="Submit">Submit</button>
            </form>
        </div>  

</body>
</html>