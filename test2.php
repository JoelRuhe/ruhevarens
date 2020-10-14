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

if(isset($_GET["selectedPlant"])) {
        $id = $_GET["selectedPlant"];
         $sql = "SELECT * FROM plants WHERE id = '$id'";
           $sth = $conn->query($sql);
            $result=mysqli_fetch_array($sth);
    
            $description = $result['description']; 
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';

    
    
    ?>
<div class="container" style="width:500px; height: 500px; background-color:black;">
    
    <p style="color:white"><?php echo $description ?></p>
    
    <?php    
//        echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
//        header("Content-Type: image/jpeg");
        echo $image;
 ?>

</div>
    
    <?php
    
        
    }

?>
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
                            echo $id;
                            echo '<form method="GET"><ul id="myUL">
                                    <li><button type="submit" value="'.$id.'" name="selectedPlant">'. $row['plant_species'].'</button></li></ul></form>';    
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

  <div class="card card-body">
      
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>
    
