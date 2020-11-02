<?php
session_start();

if(!isset($_SESSION['id'])) {
 echo 'No active session';   
}else{

    include 'includes/database.php';

    $plant_species = $_POST['plant_species'];
    $pot_size = $_POST['pot_size'];
    $length = $_POST['length'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $active = $_POST['checkbox'];
    $image = $_POST['image'];    
    
    $target_dir = "plant_images/".$plant_species."/".$pot_size."/";
    $plantpage_dir = "plant_images/".$plant_species."/".$pot_size."/plantpage_image/";
    
    if (!file_exists($plantpage_dir)) {
        mkdir($plantpage_dir, 0777, true);
    }
    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

        $plantpageFile = $_FILES['plantpage_image'];
        $myFile = $_FILES['fileToUpload'];
        $fileCount = count($myFile["name"]);
        
        for ($i = 0; $i < $fileCount; $i++) {
            echo $myFile["name"][$i];
            $uploadOk = 1;
            $target_file = $target_dir . basename($myFile["name"][$i]);
            echo 'TARGET_FILE= '.$target_file.'';
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            if (move_uploaded_file($myFile["tmp_name"][$i], $target_file)) {
//                echo "The file ". htmlspecialchars( basename($myFile["name"][$i])). " has been uploaded to ".$target_file.".";
              } else {
//                echo "Sorry, there was an error uploading your file.";
              }
        }
    
        $target_file = $plantpage_dir . basename($_FILES['plantpage_image']['name']);
        if (move_uploaded_file($_FILES['plantpage_image']['tmp_name'], $target_file)) {
            echo 'succesfully uploaded plant image to plants.php';
        }
        else{
            echo 'Could not upload plant image to plants.php';
        }
        

if(isset($_POST["checkbox"])) {
    
    $active = '1';
    $sql = "INSERT INTO plants (plant_species, pot_size, length, description, price, active, image_path) VALUES ('$plant_species', '$pot_size', '$length', '$description', '$price', '$active', '$target_dir')";
    $conn->query($sql);
    echo "<script>window.location='admin.php'</script>";
}
    
if(!isset($_POST["checkbox"])) {
    
    $active = '0';
    $sql = "INSERT INTO plants (plant_species, pot_size, length, description, price, active, image_path) VALUES ('$plant_species', '$pot_size', '$length', '$description', '$price', '$active', '$target_dir')";
    $conn->query($sql);
    echo "<script>window.location='admin.php'</script>";
}
 
?>

<html>

<body>
    <form action="admin.php">
        <input type="submit" value="back" />
    </form>
</body>

</html>

<?php
}
?>
