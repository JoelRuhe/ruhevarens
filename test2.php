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

?>
<div class="padding">
<form method="get">
<button id="edit_button" type="submit" name="edit_button" value="5"><i class="material-icons">&#xE254;</i></button>
</form>
    <div class="container justify-content-center">
        <form method="post" class="form-horizontal">
    
<?php            
    if(isset($_GET["edit_button"])) {
        $id = $_GET["edit_button"];
        $sql = "SELECT * FROM plants WHERE id = '$id'";
        if($result = mysqli_query($conn, $sql)){
            
            while($row = mysqli_fetch_array($result)) {
            $plant_species = $row['plant_species']; 
}           
        }
        else{
            echo 'else statement';
        }
    }

    echo '<div class="form-group">
      <label class="control-label col-sm-2">Plantsoort:</label>
      <div class="col-sm-10">
        <input type="name" class="form-control" id="plant_species_edit" value="'.$plant_species.'"  name="plant_species_edit" required="required">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Potgrootte:</label>
      <div class="col-sm-10">          
        <input type="name" class="form-control" id="pot_size_edit" name="pot_size_edit" required="required">
      </div>
    </div>
    <div  class="form-group">
      <label class="control-label col-sm-2">Omschrijving:</label>
      <div class="col-sm-10">          
        <textarea rows = "5" cols = "60" type="name" class="form-control" id="description_edit" name="description_edit"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-sm-2">Prijs:</label>
      <div class="col-sm-10">          
        <input type="name" class="form-control" id="price_edit" name="price_edit" required="required">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2">Afbeelding:</label>
      <div class="col-sm-10">          
        <input type="file" name="image_edit" class="form-control-file" id="image_edit">            
        </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button style="margin-top:10px; font-weight: bold;" type="submit" class="btn btn-default" name="editPlantSubmit">Bewerk plant</button>
      </div>
    </div>';


    ?>
          </form> 
    </div>
</div>

