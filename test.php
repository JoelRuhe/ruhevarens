<?php
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


 function uploadImage($pot_size, $plant_species, $image, $target_file, $target_dir){
    echo ' TEST';
   
}



//ADD PLANT
    $plant_species = $_POST['plant_species'];
    $pot_size = $_POST['pot_size'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $active = $_POST['checkbox'];
    $image = $_POST['image'];
//    $target_dir = "plant_images/".$plant_species."/".$pot_size."/";
//    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


if(isset($_POST["addPlantSubmit"]) && isset($_POST["checkbox"])) {
    

    $pot_size = $pot_size;
    $target_dir = "plant_images/".$plant_species."/".$pot_size."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
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
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    
    $active = '1';
    $sql = "INSERT INTO plants (plant_species, pot_size, description, price, active, image) VALUES ('$plant_species', '$pot_size', '$description', '$price', '$active', '$image')";
    $conn->query($sql);
//    echo "<script>window.location='admin.php'</script>";
}


?>

<html>
<body>
<form action="upload.php" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label col-sm-2">Plantsoort:*</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="plant_species"  name="plant_species" required="required">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Potgrootte:*</label>
              <div class="col-sm-10">          
                <input type="name" class="form-control" id="pot_size" name="pot_size" required="required">
              </div>
            </div>
           <div  class="form-group">
              <label  class="control-label col-sm-2">Omschrijving:</label>
              <div class="col-sm-10">          
                  <textarea rows = "5" cols = "60" type="name" class="form-control" id="description" name="description"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label  class="control-label col-sm-2">Prijs:*</label>
              <div class="col-sm-10">          
                <input type="name" class="form-control" id="price" name="price" required="required">
              </div>
            </div>
             <div class="form-group">
              <label  class="control-label col-sm-2">Actief*</label>
              <div class="col-sm-10">          
                <input type="checkbox" class="form-control" id="checkbox" name="checkbox">
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2">Afbeelding:</label>
              <div class="col-sm-10">          
                <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Upload Image" name="submit">
              </div>
            </div>
          </form>     
</body>
</html>

