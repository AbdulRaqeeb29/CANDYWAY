<?php
session_start();
include "databse_conn.php";
$current_time = time();
if(isset($_SESSION['userid'])) {
  if($current_time > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    echo "<script>window.location.href ='home.php'</script>";
}

}
if(!isset($_SESSION['userid'])) {
  echo "<script>window.location.href ='login.php'</script>";
}
else {
    $id = $_SESSION['userid'];
    if(!empty($_POST["name1"]) && !empty($_POST["country"]) && !empty($_POST["product"]) && !empty($_POST["query"])) {
          $name = $_POST['name1'];
          $country = $_POST['country'];
          $product = $_POST['product'];
          $query = $_POST['query'];
          $sql = "INSERT INTO contact (name, country, product, query,userid) VALUES ('$name', '$country', '$product', '$query','$id')";
          $result = mysqli_query($link, $sql);
          if($result) {
              echo "<script>alert('Feedback successfully submitted.')</script>";
              echo "<script>window.location.href ='home.php'</script>";
          }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="1.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta charset="UTF-8" />
    <title>CANDYWAY</title>
  </head>
  <body>
    <section id="topnav">
      <div class="nav">
        <div class="logo">
          <img src="CW_logo.webp" onclick="location.href='home.php'" alt="Logo" />
        </div>
    </section>
    

    <section id="navbar">
      <div class="nav">
        <div class="pagenav"><a href="home.php">Home</a> > Contact us</div>
        <div class="menu">
          <ul>
            <li>
              <button onClick="location.href='shop.php'" class="blue-btn">
                Shop
              </button>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <h3 style="text-align: center; margin-bottom:10px;">CONTACT US!</h3>
    <form method="post" action="contact.php">
        <div class="contactcss">

        
        <fieldset style="border:none;">
        <legend style="margin-bottom: 30px;">Details</legend>
    <p>
        <label> </label>
        <input type="text" placeholder="Name" name="name1" required/>
    </p> 
    <p>
        <label> </label>
        <select name="country" placeholder="Country" class='contact_country' required>
            <option value="" disabled selected>Choose a country</option>
            <option value="canada">Canada</option>
            <option value="united kingdom">United Kingdom</option>
            <option value="united states">United States</option>
            <option value="india">India</option>
        </select>          
    </p>  
    <p>
        <label> </label>
        <select name="product" placeholder="Product" class='contact_country' required>
            <option value="" disabled selected>Product</option>
            <option value="blue snowflake">Blue Snowflake</option>
            <option value="caramel almonds">Caramel Almonds</option>
            <option value="chocolate brazil nut">Chocolate Brazil Nut</option>
            <option value="oro regaliz">Oro Regaliz</option>
            <option value="kings marshmallow">King's Marshmallow</option>
            <option value="other">Other/Not listed</option>
        </select>
    </p> 
    <p>
        <label> </label>
        <input type="text"placeholder="Your query" name="query" required/>
        
    </p>
    <input type="submit" class="transparent-btn" name="submit_qry" />
        </fieldset>
    </div>    
    </form>
        


    </p>
</body>
</html>    