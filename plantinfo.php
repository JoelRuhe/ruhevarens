<html>
<?php
    
    include 'includes/head.html';
    include 'includes/header.php';
    include 'includes/database.php';



    $id = $_POST['selectedplant'];

    $sql = "SELECT * FROM plants WHERE id = '$id'";

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $plant_species = $row['plant_species'];
                $pot_size = $row['pot_size'];
                $length = $row['length'];
                $description = $row['description'];
                $price = $row['price'];
                $image_path = $row['image_path'];
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
            <div class="col-md-6 d-flex justify-content-center">
                <?php 
                 $imagesPNG = glob($image_path."*.{png,PNG}", GLOB_BRACE);                       
                 $imagesJPG = glob($image_path."*.{jpg,JPG}", GLOB_BRACE);
                        
                 $image_array = array_merge($imagesPNG,$imagesJPG);
                        
                    echo '<div>';

                    for ($i = 0; $i < count($image_array); $i++) {
                    
                        echo '<div style="text-align:center;" class="mySlides fade ">
                        <div class="numbertext">'. ($i+1) .' / '.count($image_array).'</div>
                        <img src="'.$image_array[$i].'" style="height:auto; width:80%;" object-fit: cover;">
                        </div>';
                    }
                  
                  echo '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
                
                <div style="margin-top:20px; text-align:center">';
                        for ($i = 0; $i < count($image_array); $i++) {
                
                        echo '<span class="dot" onclick="currentSlide('.($i+1).')"></span>';
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
                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " active";
                    }

                </script>
            </div>
            <div class="col-md-6">
                <div style="margin-left:100px;">

                    <h4>Omschrijving</h4>

                    <p style="margin-top:10px; font-size:18px;"><?php echo $description;?></p>
                    <div style="display: flex; align-items: center;" class="row">
                        <img style="width:25px; height:25px; margin-right:5px; margin-top:10px;" src="img/pagelines-brands.svg">
                        <p style="margin-top:30px; font-size:18px;">Potgrootte: <?php echo $pot_size;?> cm</p>
                    </div>
                    <div style="display: flex; align-items: center;" class="row">
                        <img style="width:25px; height:25px; margin-right:5px;" src="img/big-ruler.svg">
                        <p style="margin-top:15px; font-size:18px;">Lengte: <?php echo $length;?> cm</p>
                    </div>
<!--
                    <div style="display: flex; align-items: center;" class="row">
                        <img style="width:20px; height:20px; margin-right:5px; margin-left:5px;" src="img/euro.svg">
                        <p style="margin-top:15px;font-size:18px;">Prijs: €<?php //echo $price;?>,-</p>
                    </div>
-->
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

</body>

</html>
