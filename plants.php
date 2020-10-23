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
    var cw = $('.child').width();
    $('.child').css({
        'height': cw + 'px'
    });

</script>

<body>
    <div class="landing-text-aboutus">
        <h1>ONZE PLANTEN</h1>
    </div>
    <div style="margin-bottom:5%;">
    <div class="text-center" style="margin-left:15%; margin-right:15%; margin-top:5%;">
        <div class="row text-center">
            <div class="col-md-12">
                <form method="POST" role="search">
                    <div style="width:50%; margin-left:25%;" class="input-group">
                        <input name="searchbox" id="searchbox" placeholder="Zoek plant..." list="encodings" type="text" class="form-control">
                        <div class="input-group-btn">
                            <button type="submit" name="submitSearch" class="btn btn-search btn-info">
                                <span class="glyphicon glyphicon-search"></span>
                                <span class="label-icon">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
        $i = 0; # start a loop counter at 1 
            $sql = "SELECT * FROM plants GROUP BY plant_species, id ORDER BY plant_species";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                       if(!isset($_POST["submitSearch"])){
                       echo '<div id="standardDiv" style="display:block;">
                             <div class="row">';
                    while($row = mysqli_fetch_array($result)){
            
                    if ($i!=0 && $i%6==0) echo '</div><div class="row">';
                    if ($row["active"] == 1){
        ?>

        <div style="margin-top:5%;" class="col-sm-2" data-role="plant_species">
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

<!--                        <p style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="card-text"><?php //echo $row["description"]; ?></p>-->
                        <div class="row justify-content-center">
                            <img style="width:15px; height:15px; margin-right:5px;" src="img/pagelines-brands.svg">
                            <h5 style="font-size:13px;">Potgrootte: <?php echo '<span font-size:13px;">' .$row['pot_size']. ' cm</span>'; ?></h5>
                        </div>
                        <div class="row justify-content-center">
                            <img style="width:14px; height:14px; margin-right:5px;" src="img/big-ruler.svg">
                            <h5 style="font-size:13px;">Lengte: <?php echo '<span font-size:13px;">' .$row['length']. ' cm</span>'; ?></h5>
                        </div>
                        <div class="row justify-content-center">
                            <img style="width:11px; height:11px; margin-right:5px; margin-top:2px;" src="img/euro.svg">
                            <h5 style="margin-bottom:10%;font-size:13px;">Prijs: €<?php echo $row['price']; ?>,-</h5>
                        </div>

                        <button value="<?php echo $row["id"]; ?>" name="selectedplant" type="submit" class="btn btn-primary">Bekijk plant</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
                }
            $i++;
            }
            echo '</div>
                  </div>';
            
            }
        }
    }
        
        
        
        ?>

    </div>
    <?php 
         if(isset($_POST["submitSearch"])){
             ?>
    <div id="searchDiv" style="margin-left:15%; margin-right:15%;">
        <?php
            $search_input = $_POST["searchbox"];    
             
            if(empty($search_input)){
                $sql = "SELECT * FROM plants GROUP BY plant_species, id ORDER BY plant_species ";
            } 
            else{
                $sql = "SELECT * FROM plants WHERE UPPER(plant_species) LIKE UPPER('%" . $search_input . "%') or UPPER(pot_size) LIKE UPPER('%" . $search_input . "%') ";

            }
            
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                    echo '<div class="row">';
                    while($row = mysqli_fetch_array($result)){
            
                    if ($i!=0 && $i%6==0) echo '</div><div class="row">';
                    if ($row["active"] == 1){
        ?>

       <div style="margin-top:5%;" class="col-sm-2" data-role="plant_species">
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

                        <h5 style="margin-top:20px;" class="card-title text-center"><?php echo $row["plant_species"]; ?></h5>

<!--                        <p style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="card-text text-center"><?php //echo $row["description"]; ?></p>-->
                        <div class="row justify-content-center">
                            <img style="width:15px; height:15px; margin-right:5px;" src="img/pagelines-brands.svg">
                            <h5 style="font-size:13px;">Potgrootte: <?php echo '<span font-size:13px;">' .$row['pot_size']. '</span> cm'; ?></h5>
                        </div>
                        <div class="row justify-content-center">
                            <img style="width:14px; height:14px; margin-right:5px;" src="img/big-ruler.svg">
                            <h5 style="font-size:13px;">Lengte: <?php echo '<span font-size:13px;">' .$row['length']. ' cm</span>'; ?></h5>
                        </div>
                        <div class="row justify-content-center">
                            <img style="width:11px; height:11px; margin-right:5px; margin-top:2px;" src="img/euro.svg">
                            <h5 style="margin-bottom:10%;font-size:13px;">Prijs: €<?php echo $row['price']; ?>,-</h5>
                        </div>

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
                else{
                ?>
        <div class="text-center" style="margin-top:10%; margin-bottom:15%;">
            <h5 style="font-size:25px;" class="lead">Geen zoekresultaten gevonden, sorry! 😕</h5>
            <form method="POST">
                <button style="margin-top:20px;" type="submit" class="btn btn-primary">Terug</button>
            </form>
        </div>
        <?php
            
        }
            }
         }
    
    ?>
    </div>
    </div>
    <?php
  include 'footer.php';  
?>
</body>

</html>
