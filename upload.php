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

    $plant_species = $_POST['plant_species'];
    $pot_size = $_POST['pot_size'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $active = $_POST['checkbox'];
    $image = $_POST['image'];    
    
    $target_dir = "plant_images/".$plant_species."/".$pot_size."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded to ".$target_file.".";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }


if(isset($_POST["checkbox"])) {
    
    $active = '1';
    $sql = "INSERT INTO plants (plant_species, pot_size, description, price, active, image_path) VALUES ('$plant_species', '$pot_size', '$description', '$price', '$active', '$target_file')";
    $conn->query($sql);
    echo "<script>window.location='admin.php'</script>";
}
    
if(!isset($_POST["checkbox"])) {
    
    $active = '0';
    $sql = "INSERT INTO plants (plant_species, pot_size, description, price, active, image_path) VALUES ('$plant_species', '$pot_size', '$description', '$price', '$active', '$target_file')";
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
