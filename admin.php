<?php 
session_start();



if(!isset($_SESSION['id'])) {
 echo 'No active session';   
}
else{
include "head.html";
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

// Check if directory is empty
function is_dir_empty($dir) {
    if (!is_readable($dir)) return NULL; 
    return (count(scandir($dir)) == 2);
}    

// Delete directory with everything in it recursively
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
    
//REMOVE PLANT
if(isset($_GET["del_button"])) {
    $id = $_GET["del_button"];
    
    $sql = "SELECT * FROM plants WHERE id = '$id'";

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $plant_species = $row['plant_species'];
                $pot_size = $row['pot_size'];
            
                $plant_species = $row['plant_species'];
                $pot_size = $row['pot_size'];
                $dirpath = 'plant_images/'.$plant_species.'/'.$pot_size.'/';
                $species_path = 'plant_images/'.$plant_species.'/';
                if (file_exists($dirpath)) {
                    deleteDir($dirpath);
                    if(is_dir_empty($species_path)){
                        deleteDir($species_path);
                    }
                }
            }
        }
    }  
    $sql = "DELETE FROM plants WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
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
            <form action="upload.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-2">Plantsoort:*</label>
                    <div class="col-sm-10">
                        <input type="name" class="form-control" id="plant_species" name="plant_species" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Potgrootte:*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pot_size" name="pot_size" required="required">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-sm-2">Lengte:*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="length" name="length" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Omschrijving:</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="60" type="name" class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Prijs:*</label>
                    <div class="col-sm-10">
                        <input type="name" class="form-control" id="price" name="price" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Actief:</label>
                    <div class="col-sm-10">
                        <input type="checkbox" class="form-control" id="checkbox" name="checkbox">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Afbeelding:</label>
                    <div class="col-sm-10">
                        <input type="file" name="fileToUpload[]" class="form-control-file" id="fileToUpload" multiple>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Afbeelding voor plantenpagina:</label>
                    <div class="col-sm-10">
                        <input type="file" name="plantpage_image" class="form-control-file" id="plantpage_image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input style="margin-top:10px; font-weight: bold;" type="submit" class="btn btn-default" value="Voeg plant toe">
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

        function RemoveImage() {

        }

    </script>

    <div class="padding">
        <div class="container justify-content-center">
            <?php
                $sql = "SELECT * FROM plants ORDER BY plant_species";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<input style="margin-bottom:20px;" class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek plant...">';
                            echo "<table id='myTable' class='table'>";
                                echo "<tr>";
                                    echo "<th>Plantsoort</th>";
                                    echo "<th>Potgrootte</th>";
                                    echo "<th>Lengte</th>";
                                    echo "<th>Prijs</th>";
                                    echo "<th>Actief</th>";
                                    echo "<th>Acties</th>";
                                echo "</tr>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['plant_species'] . "</td>";
                                    echo "<td>" . $row['pot_size'] . "</td>";
                                    echo "<td>" . $row['length'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    if ($row['active'] == '1'){
                                        echo "<td> <input type='checkbox' checked onclick='return false;' /> </td>";
                                    } 
                                    if ($row['active'] == '0'){
                                        echo "<td> <input type='checkbox' onclick='return false;' /> </td>";
                                    } 

                                    echo '<td><form method="get">

                                    <button style="border: none; background: none;" type="submit" id="edit_button" name="edit_button" value="'.$row['id'].'"><i class="material-icons">&#xE254;</i></button>

                                    <button style="border: none; background: none;" type="submit" name="del_button" value="'.$row['id'].'"><i class="material-icons">&#xE872;</i></button>

                                     </form></td>';
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                    echo "No records matching your query were found.";
                        }
                }
            ?>
        </div>
    </div>

    <div class="padding">
        <div class="container justify-content-center">
            <form action="uploadEdit.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                <?php            
                    if(isset($_GET["edit_button"])) {
                        $id = $_GET["edit_button"];
                        $sql = "SELECT * FROM plants WHERE id = '$id'";
                        if($result = mysqli_query($conn, $sql)){
                            while($row = mysqli_fetch_array($result)) {
                                $plant_species_edit = $row['plant_species']; 
                                $pot_size_edit = $row['pot_size']; 
                                $length_edit = $row['length']; 
                                $description_edit = $row['description']; 
                                $price_edit = $row['price']; 
                                $active_edit = $row['active']; 
                                $image_path_edit = $row['image_path']; 
                            }
                            echo "<script>window.location.hash='plant_species_edit'</script>";
                        }
                    }

                echo 
                '<input type="hidden" name="old_plant_species_edit" value="'.$plant_species_edit.'"/>
                <input type="hidden" name="old_pot_size_edit" value="'.$pot_size_edit.'"/>

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
                    <input type="text" class="form-control" id="pot_size_edit" name="pot_size_edit" value="'.$pot_size_edit.'" required="required">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Lengte:*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="length_edit" name="length_edit" value="'.$length_edit.'" required="required">
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
                  <label  class="control-label col-sm-2">Actief:</label>
                  <div class="col-sm-10">';
                    if($active_edit == '1'){
                    echo '<input type="checkbox" class="form-control" id="checkbox_edit" name="checkbox_edit" checked>';
                    }
                    if($active_edit == '0'){
                    echo '<input type="checkbox" class="form-control" id="checkbox_edit" name="checkbox_edit">';
                    }
                echo '</div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2">Afbeelding:</label>
                  <div class="col-sm-10">          
                    <input type="file" name="fileToUpload_edit[]" class="form-control-file" id="fileToUpload_edit" multiple>            
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Afbeelding voor plantenpagina:</label>
                  <div class="col-sm-10">          
                    <input type="file" name="plantpage_image_edit" class="form-control-file" id="plantpage_image_edit" >            
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Afbeelding verwijderen:</label>
                  <div class="col-sm-10">          
                    </div>
                </div>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <input style="margin-top:10px; font-weight: bold;" type="submit" class="btn btn-default" value="Bewerk plant">
                  </div>
                </div>';
                ?>
            </form>
        </div>
    </div>

<?php 
    include 'footer.php';
}
?>
</body>
