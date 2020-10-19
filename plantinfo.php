<html>
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


    $id = $_POST['selectedplant'];

    $sql = "SELECT * FROM plants WHERE id = '$id'";

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $plant_species = $row['plant_species'];
                $description = $row['description'];
                $price = $row['price'];
                $image_path = $row['image_path'];
            }
        }
    }
    
    $potgrootte_sql = "SELECT plant_species, GROUP_CONCAT(pot_size) FROM plants WHERE plant_species = '$plant_species'";
    
    if($result2 = mysqli_query($conn, $potgrootte_sql)){
        if(mysqli_num_rows($result2) > 0){
            while($row2 = mysqli_fetch_array($result2)){
                $pot_size = $row2['GROUP_CONCAT(pot_size)'];
            }
        }
    }

?>

<body>

    <div style="margin-top:100px; margin-bottom:150px;" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="landing-text-aboutus">
                    <h1><?php echo $plant_species ?></h1>
                </div>

            </div>
        </div>
        <div style="margin-top:100px;" class="row">
            <div class="col-sm-6">
                <?php echo '<img style="display:block; margin-left: auto; margin-right: auto; height:400px; width:400px;" src="'.$image_path.'">';?>
            </div>
            <div class="col-sm-6">
                <div style="margin-left:100px;">
                    <?php
                        echo '<h2>Omschrijving</h2>
                        <p style="margin-top:10px; font-size:18px;">'.$description.'</p>
                        <p style="margin-top:30px; font-size:18px;">Potgrootte: '.$pot_size.'</p>
                        <p style="margin-top:10px; font-size:18px;">Prijs: €'.$price.'0,-</p>';
                        ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
    
</body>

</html>
