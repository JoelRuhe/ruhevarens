<html>

<head>

    <link href="plants.css" type="text/css" rel="stylesheet" />
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link href="styleSidebar.css" type="text/css" rel="stylesheet" />
</head>

<?php
    include 'head.html';
    
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
    


if(isset($_POST["selectedPlant"])) {
        $plant_species_test = $_POST["plant_species"];
        $id = $_POST["selectedPlant"];
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
}

?>





<body>
    <?php 
    include "header.php"
    ?>

    <!-- Veritical Navigation Bar -->

    <div class="padding">
        <div class="row">
            <div class="col-sm-3">
                <div class="wrapper">

                    <div style="margin-top: 100px;" class="sidebar">
                        <h2 style="color: #FFF;">Planten</h2>
                        <input style="align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek plant..">

                        <script>
                            function show() {
                                document.getElementById("CollapseDiv").style.visibility = "visible";

                            }

                        </script>

                        <?php
                        $sql = "SELECT * FROM plants";
                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $active = $row['active'];
                                    $image_path = $row['image_path'];
                                    echo '<ul id="myUL">
                                            <form method="POST">';
                                            if($active == 1){
                                             echo '<input type="hidden" name="plant_species" value"'.$row["plant_species"].'">
                                                   <li><button onClick=show() style="border: none; background: none;" type="submit" value="'.$id.'" name="selectedPlant">'.$row["plant_species"].' '.$row["pot_size"].'</button></li>';
                                            }  
                                      echo '</form>
                                        </ul>';    
                                }
                            }
                        }
                        ?>

                        <script>
                            function myFunction() {
                                // Declare variables
                                var input, filter, ul, li, a, i, txtValue;
                                input = document.getElementById('myInput');
                                filter = input.value.toUpperCase();
                                ul = document.getElementById("myUL");
                                li = ul.getElementsByTagName('li');

                                // Loop through all list items, and hide those who don't match the search query
                                for (i = 0; i < li.length; i++) {
                                    a = li[i].getElementsByTagName("a")[0];
                                    txtValue = a.textContent || a.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        li[i].style.display = "";
                                    } else {
                                        li[i].style.display = "none";
                                    }
                                }
                            }

                        </script>
                    </div>
                </div>
            </div>
            <?php
                if(isset($_POST["selectedPlant"])) {
                $plant_species_test = $_POST["plant_species"];
                $id = $_POST["selectedPlant"];
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
            ?>

            <div class="col-sm-8">
                <div class="divContainer">
                    <div class="row">
                        <div class="divWrapper">
                            <?php
                            echo '<div class="col-sm-6">';
                            echo '<img class="plantImage" src="'.$image_path.'">';
                            echo '</div>';
                            echo '<div class="col-sm-6">
                                    <h2>Omschrijving</h2>
                                    <p style="font-size:18px;">'.$description.'</p>
                                    <p style="margin-top:40px;font-size:18px;">Potgrootte: '.$pot_size.'</p>
                                    <p style="margin-top:40px;font-size:18px;">Prijs: €'.$price.'0,-</p>
                                  </div>';
            }
            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




</body>

</html>
