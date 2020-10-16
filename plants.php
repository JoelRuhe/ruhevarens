<html>

<head>

</head>

<body>
    <?php 

include 'head.html';
include 'header.php';
    
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


    <div style="margin-top:200px;" class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="GET" role="search">
                    <div class="input-group">
                        <?php
                            $sql = "SELECT * FROM plants";
                            if($result = mysqli_query($conn, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                echo '<input name="selectedPlant" placeholder="Kies of zoek uw plant..." list="encodings" type="text" class="form-control">
                                <datalist id="encodings">';

                                    while($row = mysqli_fetch_array($result)){
                                        echo $row['id'];
                                        echo 'input type="text" name="selectedPlantID" value="'.$row['id'].'">';
                                        echo '<option name="selectedPlant" value="'.$row['plant_species'].' '.$row['pot_size'].'">Potgrootte: '.$row['pot_size'].'</option>';
                                }

                             mysqli_free_result($result);
                            } else{
                                echo "No records matching your query were found.";
                            }
                        }

                       echo '</datalist>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-search btn-info">
                                <span class="glyphicon glyphicon-search"></span>
                                <span class="label-icon">Search</span>
                            </button>
                        </div>';?>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <?php
    if(!isset($_GET["selectedPlant"])){
    ?>
        <div class="padding">
            <div class="container">
                <div style="margin-top:10%; margin-bottom:15%;">
                    <h1 style="text-align:center">Zoek of selecteer een plant.</h1>
                    <img src="img/fern.png" s style="display:block; margin-left: auto; margin-right: auto; margin-top: 30px; height: 150px; width: 150px;">
                </div>
            </div>
        </div>
        <?php
        }

    if(isset($_GET["selectedPlant"])) {
            $selected_plant = $_GET["selectedPlant"];
            list($plant_species_listitem, $pot_size_listitem) = explode(" ", $selected_plant);

            $sql = "SELECT * FROM plants WHERE plant_species = '$plant_species_listitem' and pot_size = '$pot_size_listitem'";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $id = $row['id'];
                        $plant_species = $row['plant_species'];
                        $pot_size = $row['pot_size'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_path = $row['image_path'];
                    }
        ?>
    
    <div style="margin-bottom:100px; margin-top:20px;"class="padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php echo '<img style="display:block; margin-left: auto; margin-right: auto; height:400px; width:400px;" src="'.$image_path.'">';?>
                </div>
                <div class="col-sm-6">
                    <div style="margin-left:100px;">
                        <?php
                        echo '<h2>'.$plant_species.'</h2>
                        <p style="margin-top:10px; font-size:18px;">'.$description.'</p>
                        <p style="margin-top:30px; font-size:18px;">Potgrootte: '.$pot_size.'</p>
                        <p style="margin-top:10px; font-size:18px;">Prijs: €'.$price.'0,-</p>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
        }
        else{
    ?>
    <div class="padding">
        <div class="container">

            <div style="margin-top:10%; margin-bottom:15%;">
                <h2 style="text-align:center">Sorry!</h2>
                <p style="text-align:center">Geen zoekresultaten gevonden.</p>
            </div>

        </div>
    </div>
    <?php
        }
    }
}

include 'footer.php';
?>
</body>

</html>
