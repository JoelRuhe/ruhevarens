<html>

<head>

    <style>
        .image-upload>input {
            display: none;
        }


    </style>
</head>

<body>
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
  
 <script>
    function show() 
            {
                document.getElementById("suppliers").style.visibility = "visible";
            }
</script>

<div class="row" id="suppliers" style="visibility:hidden" name="suppliers">Content of div</div>
<input type="button" value="show" onClick="show()"/>    
    
</body>
    
    

</html>
