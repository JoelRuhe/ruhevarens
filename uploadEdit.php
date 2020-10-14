<?php

session_start();

if(!isset($_SESSION['id'])) {
 echo 'No active session';   
}else{

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ruhevarens";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//UPDATE PLANT
$id_edit = $_POST['id_edit'];
$plant_species_edit = $_POST['plant_species_edit'];
$pot_size_edit = $_POST['pot_size_edit'];
$description_edit = $_POST['description_edit'];
$price_edit = $_POST['price_edit'];
$image_edit = $_POST['image_edit'];
$old_plant_species_edit = $_POST['old_plant_species_edit'];
$old_pot_size_edit = $_POST['old_pot_size_edit'];
$old_target_dir = "plant_images/".$old_plant_species_edit."/".$old_pot_size_edit."/";
echo 'OLD POT SIZE' . $old_pot_size_edit;




$target_dir = "plant_images/".$plant_species_edit."/".$pot_size_edit."/";
$target_file = $target_dir . basename($_FILES["fileToUpload_edit"]["name"]);
echo $target_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



if (file_exists($target_file)) {
    unlink($target_file);
}
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check file size
if ($_FILES["fileToUpload_edit"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload_edit"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload_edit"]["name"])). " has been uploaded to ".$target_file.".";
      
//      echo 'OLD_DIR' . $old_target_dir;
//      array_map('unlink', glob("$old_target_dir/*.*"));
//      rmdir($old_target_dir);
  }
//    if($_FILES["fileToUpload_edit"]["tmp_name"] == 0){
//        $results = glob ($old_target_dir."*.jpg");
//        echo '<br>';
//        foreach ($results as &$value) {
//            echo 'Value:'. $value . '<br>';
//            echo 'target_dir:'. $target_dir . '<br>';
//
//            copy($value, $target_file);
//        }
//    }
    else {
    echo "Sorry, there was an error uploading your file.";
  }
}




    
if (!isset($_POST["checkbox_edit"])) {
   $sql = "UPDATE plants SET ";
    
    $image_path_edit = $target_file;
    $active_edit_sec = '0';
    
    if(!empty($plant_species_edit)) {
    $sql .= "plant_species= '$plant_species_edit',";
    }
    if(!empty($pot_size_edit)) {
        $sql .= "pot_size= '$pot_size_edit',";
    }
    if(!empty($description_edit)) {
        $sql .= "description= '$description_edit',";
    }
    if(!empty($price_edit)) {
        $sql .= "price= '$price_edit',";
    }
 
    $sql .= "active= '$active_edit_sec',";
    
    if(!empty($image_path_edit)) {
        $sql .= "image_path= '$image_path_edit',";
    }

    // strip off any extra commas on the end
    $sql = rtrim($sql, ',');

    $sql .= "WHERE id='$id_edit'";
    
    if ($conn->query($sql) === TRUE) {
//        echo "Record removed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<script>window.location='admin.php#myTable'</script>";
}

if (isset($_POST["checkbox_edit"])) {
    $sql = "UPDATE plants SET ";
    
    $image_path_edit = $target_file;
    $active_edit = '1';
    
    if(!empty($plant_species_edit)) {
    $sql .= "plant_species= '$plant_species_edit',";
    }
    if(!empty($pot_size_edit)) {
        $sql .= "pot_size= '$pot_size_edit',";
    }
    if(!empty($description_edit)) {
        $sql .= "description= '$description_edit',";
    }
    if(!empty($price_edit)) {
        $sql .= "price= '$price_edit',";
    }
    if(!empty($active_edit)) {
        $sql .= "active= '$active_edit',";
    }
    if(!empty($image_path_edit)) {
        $sql .= "image_path= '$image_path_edit',";
    }

    // strip off any extra commas on the end
    $sql = rtrim($sql, ',');

    $sql .= "WHERE id='$id_edit'";
    
    if ($conn->query($sql) === TRUE) {
//        echo "Record removed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<script>window.location='admin.php#myTable'</script>";
}
}
?>