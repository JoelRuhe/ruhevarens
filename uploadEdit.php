<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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


function is_dir_empty($dir) {
    if (!is_readable($dir)) return NULL; 
    return (count(scandir($dir)) == 2);
}

function recursiveDelete($str) {
    if (is_file($str)) {
        return @unlink($str);
    }
    elseif (is_dir($str)) {
        $scan = glob(rtrim($str,'/').'/*');
        foreach($scan as $index=>$path) {
            recursiveDelete($path);
        }
        return @rmdir($str);
    }
}
    
function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException($dirPath."must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
    
//UPDATE PLANT
$id_edit = $_POST['id_edit'];
$plant_species_edit = $_POST['plant_species_edit'];
$pot_size_edit = $_POST['pot_size_edit'];
$description_edit = $_POST['description_edit'];
$price_edit = $_POST['price_edit'];
//$image_edit = $_POST['image_edit'];
    
$old_plant_species_edit = $_POST['old_plant_species_edit'];
$old_pot_size_edit = $_POST['old_pot_size_edit'];
$old_target_dir = "plant_images/".$old_plant_species_edit."/".$old_pot_size_edit."/";
$old_target_species ="plant_images/".$old_plant_species_edit."/";


$target_dir = "plant_images/".$plant_species_edit."/".$pot_size_edit."/";
$plantpage_dir = "plant_images/".$plant_species_edit."/".$pot_size_edit."/plantpage_image/";
//$target_file = $target_dir . basename($_FILES["fileToUpload_edit"]["name"]);
//echo $target_file;

if ($plant_species_edit != $old_plant_species_edit || $pot_size_edit != $old_pot_size_edit){
    
    //First copy old directory and remove it, then append new selected images.
//    echo 'OLD_TARGET_DIR: '.$old_target_dir.'<br>';
//    echo 'NEW_TARGET_DIR: '.$target_dir.'<br><br>';
//    
//    echo 'OLD PLANT SPECIES: '.$old_plant_species_edit.'<br>';
//    echo 'NEW PLANT SPECIES: '.$plant_species_edit.'<br><br>';
//    
//    echo 'OLD POT SIZE: '.$old_pot_size_edit.'<br>';
//    echo 'NEW POT SIZE: '.$pot_size_edit.'<br><br>';
    
    if(!file_exists($target_dir)){
        mkdir($target_dir, 0777, true);
    }
    
    recurse_copy($old_target_dir, $target_dir);
    deleteDir($old_target_dir);
    if(is_dir_empty($old_target_species)){
         deleteDir($old_target_species);
    }
}

//Append images for plantinfo.php fileToUpload_edit
$myFile = $_FILES['fileToUpload_edit'];
if ($_FILES['fileToUpload_edit']['size'] != 0 && $_FILES['fileToUpload_edit']['error'] != 0){
    $fileCount = count($myFile["name"]);
    for ($i = 0; $i < $fileCount; $i++) {
        $target_file = $target_dir . basename($myFile["name"][$i]);
        if (move_uploaded_file($myFile["tmp_name"][$i], $target_file)) {
//             echo 'Image upload succeeded.<br><br>';
         }
         else {
//             echo 'Image upload failed. <br><br>';
         }
    }
}
    

//Append image for plants.php
if ($_FILES['plantpage_image_edit']['size'] != 0){
    
    //Remove old image
    recursiveDelete($plantpage_dir);
    
    //Add new image
    if (!file_exists($plantpage_dir)) {
        mkdir($plantpage_dir, 0777, true);
    }
    
    $target_file = $plantpage_dir . basename($_FILES['plantpage_image_edit']['name']);
    
    if (move_uploaded_file($_FILES['plantpage_image_edit']['tmp_name'], $target_file)) {
//        echo 'succesfully uploaded plant image to plants.php';
    }
    else{
//        echo 'Could not upload plant image to plants.php';
    }
}


//if (file_exists($target_file)) {
//    unlink($target_file);
//}
//if (!file_exists($target_dir)) {
//    mkdir($target_dir, 0777, true);
//}
//
//// Check file size
//if ($_FILES["fileToUpload_edit"]["size"] > 500000) {
//  echo "Sorry, your file is too large.";
//  $uploadOk = 0;
//}
//
//// Check if $uploadOk is set to 0 by an error
//if ($uploadOk == 0) {
//  echo "Sorry, your file was not uploaded.";
//// if everything is ok, try to upload file
//} else {
//  if (move_uploaded_file($_FILES["fileToUpload_edit"]["tmp_name"], $target_file || ($_FILES["fileToUpload_edit"]["size"] == 0 && $_FILES['fileToUpload_edit']['error'] == 0))) {
//    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload_edit"]["name"])). " has been uploaded to ".$target_file.".";
//       echo 'OLD_DIR:' . $old_target_dir;
//      
//      recurse_copy($old_target_dir,$target_dir);
//          
//     
////      array_map('unlink', glob("$old_target_dir/*.*"));
////      rmdir($old_target_dir);
//  }
////    if($_FILES["fileToUpload_edit"]["tmp_name"] == 0){
////        $results = glob ($old_target_dir."*.jpg");
////        echo '<br>';
////        foreach ($results as &$value) {
////            echo 'Value:'. $value . '<br>';
////            echo 'target_dir:'. $target_dir . '<br>';
////
////            copy($value, $target_file);
////        }
////    }
//    else {
//    echo "Sorry, there was an error uploading the image.";
//  }
//}




    
if (!isset($_POST["checkbox_edit"])) {
   $sql = "UPDATE plants SET ";
    
    $image_path_edit = $target_dir;
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
    
    $image_path_edit = $target_dir;
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
