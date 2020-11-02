<!DOCTYPE html>
<html>
    <?php include "includes/head.html" ?>
    
<body>
    <?php include "includes/header.php" ?>


<div style="background: url(img/mountains.jpeg) no-repeat center center fixed; display: table; height: 100%; position: relative; width: 100%; background-size: cover;" id="home">
    <div class="landing-text">
        <h4>Welkom bij</h4>
        <h1>RUHE PLANTS</h1>
        <h4>Leuk dat je onze site bezoekt! Dan ben jij vast geïnteresseerd in onze planten…</h4>
    </div>
</div>
    

<div style="margin-top:2%;" class="padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="img/Alocasia_Polly_Stek.jpg">
            </div>
            <div class="col-sm-6 my-auto">
                <h3>Het begint bij het verspenen</h3>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo. </p>
                 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo. </p>
            </div>
        </div>
    </div>
</div>
    
<div class="padding">
     <div class="container">
        <div class="row">
            <div class="col-sm-6 text-right my-auto">
                <h3>Vervolgens groeien ze op...</h3>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo. </p>
                 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo. </p>
            </div>
             <div class="col-sm-6">
                <img src="img/Zaaibakken_2.jpg">
            </div>
        </div>
    </div>
</div>

<div style=" background: url(img/background.jpg) no-repeat center center fixed; display: table; height: 60%; position: relative; width: 100%; background-size: cover;">
    
</div>
    
<!-- Slideshow container -->
<div class="padding">
 <!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="img/Adiantum_Fragrans.jpg" style="width:100%">
    <div class="text">Adiantum Fragnans</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="img/Nephrolepis.jpg" style="width:100%">
    <div class="text">Nephrolepis</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="img/Zaaibakken.jpg" style="width:100%">
    <div class="text">Zaaibakken</div>
  </div>
    
  <div class="mySlides fade">
    <div class="numbertext">4 / 4</div>
    <img src="img/Pteris_Evergemiensis.jpg" style="width:100%">
    <div class="text">Pteris Evergemiensis</div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
  <span class="dot" onclick="currentSlide(4)"></span>

</div>
</div>
    
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

<!--
<div class="padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 my-auto">
                <img src="img/bootstrap2.png">
            </div>
            <div class="col-sm-6">
                <h4>Hier nog meer algemene informatie</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo </p>
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at nunc ac metus pretium dapibus. Vestibulum quis eleifend nibh. Morbi elementum nibh a augue laoreet, id dignissim risus commodo </p>
            </div>
        </div>
    </div>
</div>
-->



<?php 
    include "footer.php"
?>
</body>
</html>