<?php 
session_start();

include "head.html";



if(!isset($_SESSION['id'])) {
 echo 'No active session';   
}
else{
include "header.php"; 

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



//ADD PLANT
$plant_species = $_POST['plant_species'];
$pot_size = $_POST['pot_size'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];

if(isset($_POST["addPlantSubmit"])) {
   
    $sql = "INSERT INTO plants (plant_species, pot_size, description, price, image) VALUES ('$plant_species', '$pot_size', '$description', '$price', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<script>window.location='admin.php'</script>";
}

//REMOVE PLANT
if(isset($_GET["del_button"])) {
    $id = $_GET["del_button"];
    $sql = "DELETE FROM plants WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
//        echo "Record removed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<script>window.location='admin.php#myTable'</script>";
}
    
//UPDATE PLANT
$id_edit = $_POST['id_edit'];
$plant_species_edit = $_POST['plant_species_edit'];
$pot_size_edit = $_POST['pot_size_edit'];
$description_edit = $_POST['description_edit'];
$price_edit = $_POST['price_edit'];
$image_edit = $_POST['image_edit'];
    
if(isset($_POST["editPlantSubmit"])) {
    $sql = "UPDATE plants SET ";
    
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
     
    if(!empty($image_edit)) {
        $sql .= "image= '$image_edit',";
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

?>
<body>


<div>
    <div class="landing-text-aboutus">
        <h1>Voeg plant toe</h1>
    </div>
</div>
    
<div class="padding">
    <div class="container justify-content-center">
        <form method="post" class="form-horizontal">
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
              <label class="control-label col-sm-2">Afbeelding:</label>
              <div class="col-sm-10">          
                <input type="file" name="image" class="form-control-file" id="image">            
                </div>
            </div>
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <button style="margin-top:10px; font-weight: bold;" type="submit" class="btn btn-default" name="addPlantSubmit">Voeg plant toe</button>
              </div>
            </div>
          </form> 
    </div>
</div>



<div>
    <div class="landing-text-admin">
        <h1>Verwijder of bewerk plant</h1>
    </div>
</div>

    <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
    
<div class="padding">
    <div class="container justify-content-center"> 
        <?php
        $sql = "SELECT * FROM plants";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                    echo '<input style="margin-bottom:20px;" class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek plant...">';
                    echo "<table id='myTable' class='table'>";
                        echo "<tr>";
                            echo "<th>Plantsoort</th>";
                            echo "<th>Potgrootte</th>";
                            echo "<th>Prijs</th>";
                            echo "<th>Acties</th>";
                        echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>" . $row['plant_species'] . "</td>";
                            echo "<td>" . $row['pot_size'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo '<td><form method="get">
                            
                            <button style="border: none; background: none;" type="submit" id="edit_button" name="edit_button" value="'.$row['id'].'"><i class="material-icons">&#xE254;</i></button>

                             <button style="border: none; background: none;" type="submit" name="del_button" value="'.$row['id'].'"><i class="material-icons">&#xE872;</i></button>
                             
                            
                             </form></td>';
                        echo "</tr>";
                    }
                    echo "</table>";
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            }
        }
    ?>

    </div>
</div>
    
<div class="padding">
    <div class="container justify-content-center">
        <form method="post" class="form-horizontal">
<?php            
    if(isset($_GET["edit_button"])) {
        $id = $_GET["edit_button"];
        $sql = "SELECT * FROM plants WHERE id = '$id'";
        if($result = mysqli_query($conn, $sql)){
            
            while($row = mysqli_fetch_array($result)) {
            $plant_species_edit = $row['plant_species']; 
            $pot_size_edit = $row['pot_size']; 
            $description_edit = $row['description']; 
            $price_edit = $row['price']; 
            $image_edit = $row['image']; 

            }

            echo "<script>window.location.hash='plant_species_edit'</script>";

        }
        else{
            echo 'else statement';
        }
    }

    echo 
    '
    <div class="form-group">
      <label class="control-label col-sm-2">ID:</label>
      <div class="col-sm-10">
        <input type="name" class="form-control" id="id_edit" value="'.$id.'"  name="id_edit" required="required" readonly>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Plantsoort:</label>
      <div class="col-sm-10">
        <input type="name" class="form-control" id="plant_species_edit" value="'.$plant_species_edit.'"  name="plant_species_edit" required="required">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Potgrootte:</label>
      <div class="col-sm-10">          
        <input type="name" class="form-control" id="pot_size_edit" name="pot_size_edit" value="'.$pot_size_edit.'" required="required">
      </div>
    </div>
    <div  class="form-group">
      <label class="control-label col-sm-2">Omschrijving:</label>
      <div class="col-sm-10">          
        <textarea rows = "5" cols = "60" type="name" class="form-control" id="description_edit" value="'.$description_edit.'" name="description_edit"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-sm-2">Prijs:</label>
      <div class="col-sm-10">          
        <input type="name" class="form-control" id="price_edit" name="price_edit" value="'.$price_edit.'" required="required">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2">Afbeelding:</label>
      <div class="col-sm-10">          
        <input type="file" name="image_edit" class="form-control-file" value="'.$image_edit.'" id="image_edit">            
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


<?php 
include 'footer.php';
//$conn->close();
    
?>
    
  
</body>





    
