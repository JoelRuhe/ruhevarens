<html>
<head>
<title>Ruhe Varens</title>
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    
<link href="style.css" type="text/css" rel="stylesheet"/>
<link href="styleSidebar.css" type="text/css" rel="stylesheet"/>

</head>

<body>
<?php include "header.php"?>

<!-- Veritical Navigation Bar -->

<div class="padding">
    <div class="wrapper">
        <div style="margin-top: 100px;" class="sidebar">
            <h2 style="color: #FFF;">Planten</h2>
            <input style="align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek plant..">
            <ul id="myUL">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
                <li><a href="#">Four</a></li>
                <li><a href="#">One</a></li>
                <li><a href="#">One</a></li>
                <li><a href="#">One</a></li>
                <li><a href="#">One</a></li>
            </ul>
            
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