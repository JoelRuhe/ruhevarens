<html>
<?php include "head.html"?>

<body>
    <?php 
        include "header.php";
    
        if(isset($_POST["email_submit"])){
            $name = $_POST['name_input'];
            $email_from = $_POST['email_input'];
            $email_subject = "Contact formulier ingevuld van '$name'";
            $email_body = $_POST['message_input'];

            $email_to = "ruhejoel@gmail.com";
            $headers = "From: $email_from \r\n";

            mail($email_to,$email_subject,$email_body,$headers);
        }
    ?>

    <div id="aboutus">
        <div class="landing-text-aboutus">
            <h1>CONTACT</h1>
        </div>
    </div>
    <div class="padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Naam</label>
                                        <input name="name_input" type="text" class="form-control" id="name" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            E-mail adres</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                            </span>
                                            <input type="email" name="email_input" class="form-control" id="email" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Bericht</label>
                                        <textarea name="message_input" id="message" class="form-control" rows="9" cols="25" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="email_submit" class="btn btn-primary pull-right" id="btnContactUs">
                                        Verstuur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <form>
                        <legend style=" border-bottom:1px solid #000000;">Informatie</legend>
                        <address>
                            <strong>Adres</strong><br>
                            Amstelveen, 1187ZR, Meerlandenweg 7<br>
                            Aalsmeer, 1432KA, Legmeerdijk 141<br>
                            <abbr title="Phone">
                                T:</abbr>
                            (020) 1437126
                        </address>
                        <address>
                            <strong>Email adres</strong><br>
                            <a href="mailto:#">info@ruheplants.nl</a>
                        </address>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-bottom:100px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="container-fluid text-center" style="height: 400px; width: 600px;" id="map"></div>
                <script>
                    function initMap() {
                        var locMeerlandenweg = {
                            lat: 52.2688792,
                            lng: 4.8234958
                        };
                        var locLegmeerdijk = {
                            lat: 52.2831469,
                            lng: 4.8165951
                        };

                        var map = new google.maps.Map(
                            document.getElementById('map'), {
                                zoom: 12,
                                center: locMeerlandenweg
                            });
                        var marker = new google.maps.Marker({
                            position: locMeerlandenweg,
                            map: map
                        });
                        var marker = new google.maps.Marker({
                            position: locLegmeerdijk,
                            map: map
                        });

                    }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBStF7Jma7R28DOWHjMTMfmsnp-2H4Cjc8&callback=initMap" type="text/javascript"></script>
            </div>
        </div>
    </div>
<?php 
    include "footer.php"
?>
</body>
</html>
