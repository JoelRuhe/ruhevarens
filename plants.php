<html>

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

?>
    
<link href="style.css" type="text/css" rel="stylesheet"/>
<link href="styleSidebar.css" type="text/css" rel="stylesheet"/>
    
<body>
<?php include "header.php"?>

<!-- Veritical Navigation Bar -->

<div class="padding">
    <div class="wrapper">
        <div style="margin-top: 100px;" class="sidebar">
            <h2 style="color: #FFF;">Planten</h2>
            <input style="align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek plant..">
            
            <?php
                $sql = "SELECT * FROM plants";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $id = $row['id'];
                            echo '<ul id="myUL">
                                    <form action="#collapseContainer" method="get"><li><a data-toggle="collapse" type="submit" href="#collapseContainer" value="'.$id.'" name="selectedPlant" role="button" aria-expanded="false" aria-controls="collapseContainer">'. $row['plant_species'] .'</a></li></form>
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

<div class="collapse" id="collapseContainer">
    <?php
    
    if(isset($_GET["selectedPlant"])) {
        $id = $_GET["selectedPlant"];
         $sql = "SELECT * FROM plants WHERE id = '$id'";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $plant_species = $row['plant_species'];
                            $pot_size = $row['pot_size'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $image = $row['image'];
                        }
                    }
                }
        
    }

    ?>
  <div class="card card-body">
      <?php echo '<p>'.$plant_species.'</p>'; ?>
      
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>
    

</body>
</html>