<html>
<?php include "head.html"?>

<body>
<?php include "header.php"?>

    
    
    
<div id="aboutus">
    <div class="landing-text-aboutus">
        <h1>CONTACT</h1>
     </div>
</div>
    
<div class="padding">
    <div>
        <div class="row">
            <div class="col-sm-6">
               <div class="container-fluid text-center" style="height: 400px; width: 600px;" id="map"></div>
                    <script>
                      // Initialize and add the map
                      function initMap() {
                          // The location of Uluru
                          var locMeerlandenweg = {lat: 52.2688792, lng: 4.8234958};
                          var locLegmeerdijk = {lat: 52.2831469, lng: 4.8165951};

                          // The map, centered at Uluru
                          var map = new google.maps.Map(
                              document.getElementById('map'), {zoom: 12, center: locMeerlandenweg});
                          // The marker, positioned at Uluru
                          var marker = new google.maps.Marker({position: locMeerlandenweg, map: map});
                          var marker = new google.maps.Marker({position: locLegmeerdijk, map: map});

                        }
                    </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBStF7Jma7R28DOWHjMTMfmsnp-2H4Cjc8&callback=initMap" type="text/javascript"></script>
            </div>
            <div style="padding: 0 0 0 300px; "class="col-sm-6">
                <h3>Adres 1: Legmeerdijk 141 1432KA Aalsmeer</h3>
                <h3>Adres 2: Meerlandenweg 7 1187ZR Amstelveen</h3>
                <h3>E-mail: info@ruheplants.nl</h3>
                <h3>Telefoon: 020-1347125</h3>
            </div>
        </div>
    </div>
</div>
    
    
    
    
    
    
    
<?php include "footer.php"?>
</body>
    
  


    
</html>