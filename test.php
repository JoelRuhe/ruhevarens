<?php
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

<html>
<body>


    
<div>
    <div class="landing-text-admin">
        <h1>Verwijder plant</h1>
    </div>
</div>

<div class="padding">
    <div class="container justify-content-center">       
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Plantsoort</th>
              <th scope="col">Potgrootte</th>
              <th scope="col">Prijs</th>
            </tr>
          </thead>
          <tbody>
            <?php
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
            
            echo 'fuck';
            $sql = mysqli_query("SELECT * FROM plants");
            $result = $conn->query($sql);
           if ($result->num_rows > 0) {
                echo 'fuck';
            

            
              while($row = $result->fetch_assoc()) { 
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['plant_species']?></td>
                <td><?php echo $row['pot_size']?></td>
                <td><?php echo $row['price']?></td>
            </tr>
            <?php
            }
           }
            else{
                echo'lol';
                echo mysql_errno($conn) . ": " . mysql_error($conn) . "\n";
            }
            ?>
          </tbody>
        </table>
    </div>
</div>
       
    
</body>
</html>
