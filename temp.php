<html>

<head>
    <style>
        .child {
            width: 100%;
        }

    </style>
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
                if ($(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)) {}
            });
        });
    });

</script>

<script>
    var cw = $('.child').width();
    $('.child').css({
        'height': cw + 'px'
    });

</script>

<body>
    <div class="landing-text-aboutus">
        <h1>ONZE PLANTEN</h1>
    </div>
    <div style="margin-left:15%; margin-right:15%; margin-top:5%; margin-bottom:5%;">
        <form method="POST">
            <input name="searchbox" id="searchbox" placeholder="Zoek plant..." list="encodings" type="text" class="filterinput form-control">
            <input type="submit" "submitSearch">
        </form>
        
        <?php
        $i = 0; # start a loop counter at 1 
            $sql = "SELECT * FROM plants GROUP BY plant_species, id ORDER BY plant_species";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                    
                    echo '<div class="row">';
                    while($row = mysqli_fetch_array($result)){
            
                    if ($i!=0 && $i%4==0) echo '</div><div class="row">';
                    if ($row["active"] == 1){
        ?>

        <div style="margin-top:5%;" class="col-sm-3" d-flex justify-content-center data-role="plant_species">
            <form method="POST" action="plantinfo.php">
                <div class="card">
                    <div class="card-body">
                        <?php
                        
                        $image_path = $row["image_path"];
                        $image = glob($image_path."plantpage_image/*.{jpg,png,JPG,PNG}", GLOB_BRACE);                                     
                        if(count($image>0)){
                            echo '<img class="child" src="'.$image[0].'">';
                        }
                 
                       
                        ?>
                        <h5 style="margin-top:20px;" class="card-title"><?php echo $row["plant_species"]; ?></h5>
                        <p style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="card-text"><?php echo $row["description"]; ?></p>
                        <h5 style="font-size:13px;">Potgrootte: <?php echo '<span font-size:13px;">' .$row['pot_size']. '</span>'; ?></h5>
                        <h5 style="margin-bottom:10%;font-size:13px;">Prijs: €<?php echo $row['price']; ?>,-</h5>

                        <button value="<?php echo $row["id"]; ?>" name="selectedplant" type="submit" class="btn btn-primary">Bekijk plant</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
                }
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
