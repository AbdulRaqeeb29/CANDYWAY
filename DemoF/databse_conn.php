

<?php 
  $db = "shop_user"; //database name
  $dbuser = "root"; //database username
  $dbpassword = "root"; //database password
  $dbhost = "172.17.0.1"; //database host

  
  $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $db);
  if(!$link) {
    die('could not connect:'.mysqli_connect_error());
  }

  
?> 