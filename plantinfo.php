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
                $pot_size = $row['pot_size'];
                $description = $row['description'];
                $price = $row['price'];
                $image_path = $row['image_path'];
            }
        }
    }
    
//    $potgrootte_sql = "SELECT plant_species, GROUP_CONCAT(pot_size) FROM plants WHERE plant_species = '$plant_species'";
//    
//    if($result2 = mysqli_query($conn, $potgrootte_sql)){
//        if(mysqli_num_rows($result2) > 0){
//            while($row2 = mysqli_fetch_array($result2)){
//                $pot_size = $row2['GROUP_CONCAT(pot_size)'];
//            }
//        }
//    }

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
            <div class="col-sm-6 d-flex justify-content-center">
                <?php 
                 $imagesPNG = glob($image_path."*.{png,PNG}", GLOB_BRACE);                       
                 $imagesJPG = glob($image_path."*.{jpg,JPG}", GLOB_BRACE);
                        
                 $image_array = array_merge($imagesPNG,$imagesJPG);
                        
                    echo '<div>';

                    for ($i = 0; $i < count($image_array); $i++) {
                    
                        echo '<div class="mySlides fade">
                        <div class="numbertext">'. ($i+1) .' / '.count($image_array).'</div>
                        <img src="'.$image_array[$i].'" style="height:350px; width:auto; object-fit: cover;">
                        </div>';
                    }
                  
                  echo '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
                
                <div style="margin-top:20px; text-align:center">';
                        for ($i = 0; $i < count($image_array); $i++) {
                
                        echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
                        }
                        echo '</div>
                </div>';
                        
                     
                ?>
                <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                // Next/previous controls
                function plusSlides(n) {
                  showSlides(slideIndex += n);
                }

                // Thumbnail image controls
                function currentSlide(n) {
                  showSlides(slideIndex = n);
                }

                function showSlides(n) {
                  var i;
                  var slides = document.getElementsByClassName("mySlides");
                  var dots = document.getElementsByClassName("dot");
                  if (n > slides.length) {slideIndex = 1}
                  if (n < 1) {slideIndex = slides.length}
                  for (i = 0; i < slides.length; i++) {
                      slides[i].style.display = "none";
                  }
                  for (i = 0; i < dots.length; i++) {
                      dots[i].className = dots[i].className.replace(" active", "");
                  }
                  slides[slideIndex-1].style.display = "block";
                  dots[slideIndex-1].className += " active";
                }

                </script>
            </div>
            <div class="col-sm-6">
                <div style="margin-left:100px;">
                    <?php
                        echo '<h4>Omschrijving</h4>
                        <p style="margin-top:10px; font-size:18px;">'.$description.'</p>
                        <p style="margin-top:30px; font-size:18px;">Potgrootte: '.$pot_size.'</p>
                        <p style="margin-top:10px; font-size:18px;">Prijs: €'.$price.',-</p>';
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
