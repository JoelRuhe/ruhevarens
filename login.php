<html>
<?php include 'head.html'?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="login.css" type="text/css" rel="stylesheet">
<body>
<?php include 'header.php'?>
    
    

    
    
    
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Login Form -->
    <form method="POST">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" name="submitbutton">
    </form>
  </div>
</div>
    
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


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 

        $myusername = $_POST['username'];
        $mypassword = $_POST['password'];
        $mypassword_hashed = hash('sha512',$mypassword);

        $sql = "SELECT id FROM admin WHERE user = '$myusername' and pass = '$mypassword_hashed'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            session_start();
            $_SESSION["id"] = true;
            header('location:admin.php');
            
        } else {
          echo "Wrong Username or Password";
        }
        $conn->close();
   }

?>
    
        
<?php include 'footer.php' ?>
</body>

</html>