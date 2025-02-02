<?php
include 'Kursi.php';





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kurs = new Kursi();
    $lenda = $_POST['lenda'];
    $pershkrimi = $_POST['pershkrimi_kursit'];
   
  

    
    $result = $kurs->krijoKursin($lenda, $pershkrimi);
    echo $result;
       
    
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="KrijoKurs.css">
    <title>Edit Profile</title>
    <script>
      
      

    </script>
</head>
<body>  
    <div class="navbar">                         
       <a href="MyCourses.php" class="Close-Img"><img src="close.png" alt="closebtn" class="Close-Img"></a>               
    </div>       
   <br><br><br>

        <div  class="container">
            <form action="" method="post">
                    <label for="lenda">Per cka do te mbahet kursi: </label>
                    <input type="text" name="lenda" id="lenda">

                    <label for="pershkrimi_kursit">Shkruani diqka me shume per kete kurs: </label>
                    <textarea name="pershkrimi_kursit" id="pershkrimi" rows="6" cols="100" maxlength="500" placeholder="(500 karaktere maximumi)"></textarea>    

            <button type="Submit">Submit</button>
            </form>
        </div>                     
</body>
</html>