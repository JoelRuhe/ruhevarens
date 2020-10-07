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


    
<div class="padding">
    <div class="wrapper">
        <div style="margin-top: 100px;" class="sidebar">
            <h2 style="color: #FFF;">Planten</h2>
            <input style="align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek plant..">
            
            <?php
                $sql = "SELECT * FROM plants";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        
                            
                echo '<ul id="myUL">
                        <li><a href="#">One</a></li>
                        <li><a href="#">Two</a></li>
                        <li><a href="#">Three</a></li>
                        <li><a href="#">Four</a></li>
                        <li><a href="#">One</a></li>
                        <li><a href="#">One</a></li>
                        <li><a href="#">One</a></li>
                        <li><a href="#">One</a></li>
                    </ul>';    
                            
                            
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
       
    
</body>
</html>
