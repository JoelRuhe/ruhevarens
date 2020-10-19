<html>

<head>

</head>
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

<script>
    $(document).ready(function() {
        $("#searchbox").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $('div[data-role="plant_species"]').filter(function() {
                if($(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)){
                    
                }  
//                if($(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) < -1)){
//                alert('FUCK');
//                }
                    
                
                
            });
        });
    });

</script>

<body>
    <div style="margin-left:15%; margin-right:15%; margin-top:10%;">
        <?php
        $i = 0; # start a loop counter at 1 
            $sql = "SELECT * FROM plants";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                     echo '<input name="searchbox" id="searchbox" placeholder="Zoek plant..." list="encodings" type="text" class="filterinput form-control">';
                    echo '<div class="row">';
                    while($row = mysqli_fetch_array($result)){
            
                    if ($i!=0 && $i%4==0) echo '</div><div class="row">';
        ?>

        <div style="margin-top:5%;" class="col-sm-3" d-flex justify-content-center>
            <form method="POST" action="plantinfo.php">
                <div class="card" data-role="plant_species">
                    <div class="card-body">
                        <img src="<?php echo $row["image_path"]; ?>">
                        <h5 style="margin-top:20px;" class="card-title"><?php echo $row["plant_species"]; ?></h5>
                        <p style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="card-text"><?php echo $row["description"]; ?></p>
                        <button value="<?php echo $row["id"]; ?>" name="selectedplant" type="submit" class="btn btn-primary">Bekijk plant</button>
                    </div>
                </div>
            </form>
        </div>

        <?php

            $i++;
            }
            echo '</div>';
        }
    }
        ?>

    </div>

<?php>
  include 'footer.php';  
?>
</body>

</html>
