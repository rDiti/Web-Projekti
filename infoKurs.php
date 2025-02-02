
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
$rating = new Vleresimet($database);

$kursi = new Kursi($db);
$user = new Profile($db);

$useriSpecifik = $user->getUserById($user_id);
$allKurset = $kursi->getAllKurse();
$count=0;
$professor_id = $useriSpecifik["id"];
$mesatarjaVleresimit = $rating->mesatarjaEProfes($professor_id);
if (isset($_GET['kurs_id'])) {
    $id = $_GET['kurs_id'];
    $kursiData = $kursi->getKursiById($id);

    if (!$kursiData) {
        echo "Course not found!";
        exit;
    }
} else {
    echo "No course ID provided!";
    exit;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['vleresimi'])) {
     
        $student_id = $user_id;
        $professor_id = $useriSpecifik["id"];
        $nota = $_POST["nota"];
        
        $message = $rating->vleresoProfen($student_id, $professor_id, $nota);
        echo $message;
   
    } elseif (isset($_POST['enroll'])) {
        $kurs = new Kursi();
        $user_id = $_POST['user_id'];
        $kurs_id = $_POST['kurs_id'];
       
        $ndjekja_kursit = $kurs ->ndjek_Kursin($user_id,$kurs_id);

        if($ndjekja_kursit){

            $result = $kurs->unenrollKursStudent($kurs_id,$user_id);
            echo "<script type='text/javascript'>
            alert('Ju jeni larguar nga kursi');
             </script>";
           
            
        }else{
            echo "<script type='text/javascript'>
            alert('Ju jeni duke ndjekur kursin');
             </script>";
            $result = $kurs->enrollToKursById($kurs_id, $user_id);
            
            
        }
        
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="infoKurs.css">
    <title>My Profile</title>
    <script>
   </script>
</head>
<body>

    <div class="navbar">
       
        <img src="<?php echo htmlspecialchars($useriSpecifik['image_path']); ?>" alt="FotoProfili" class="profili" id="profili">       
        <p id="Emri_Mbiemri"><?php echo htmlspecialchars($useriSpecifik['Emri']);?> <?php echo htmlspecialchars($useriSpecifik['Mbiemri'])?></p>
        <p class="phone" id="phone"><?php echo htmlspecialchars($useriSpecifik['Nr_tel']);?> </p>
        <p class="ratings" id="ratings">Vleresimi juaj: <?php echo $mesatarjaVleresimit;?></p>
        <a href="Homepage.php" class="Close-Img"><img src="close.png" alt="closebtn" class="Close-Img"></a>   
              
    </div>   
   <br><br><br>
        <div  class="container">
        
            <p class="pershkrimi personal"><?php echo htmlspecialchars($kursiData['pershkrimi_kursit']);?> </p>
        </div>  
        <div class="butonat">
            <form action="" method="post">
                <input type="number" name="nota" min="0" max="3">
                <button type="submit" name="vleresimi">Dergo Vleresimin</button>
           
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button  class="enroll" name="enroll">Enroll</button>
            </form>
        </div>    
     

    
 
</body>
</html>