<?php 
session_start();
$current_time = time();
if(isset($_SESSION['userid'])) {
  if($current_time > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    echo "<script>window.location.href ='home.php'</script>";
}
$id = $_SESSION['userid'];
include "databse_conn.php";
$sql = "SELECT COUNT(*) AS total_count FROM cart_details WHERE userid='$id'";
$result = mysqli_query($link,$sql);
$data = mysqli_fetch_assoc($result);
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
          <img src="CW_logo.webp" alt="Logo" />
        </div>
        <div class="menu">
          <ul class="nav-menu">
            <li><a href="home.php" class="active">Home</a></li>           
            
            <li><a href="contact.php">Contact</a></li>
            
            <?php
            if(!isset($_SESSION['userid'])) {?>
              <li><button onclick="location.href='login.php'" class="transparent-btn">Login</button></li>
            <?php } 
            else {?>
              <li><button onclick="location.href='logout.php'" class="transparent-btn">Logout</button></li>
            <?php }
            ?>
            
            

            <div class=”Cart-Container”>
              <a href="cart.php">
              <span class="material-symbols-outlined" style="font-size:28px;"> 
                shopping_bag
                <?php if(isset($_SESSION['userid'])) {?>
                <div class="cart_quant" style="padding-top: 2px;"><?php echo $data['total_count'];?></div>
                <?php }?>
              </span>
              </a>
            </div>
             
            
          </ul>
          
        </div>
      </div>
    </section>
    <section id="navbar">
      <div class="nav">
        <div class="title">
          <img src="CANDYWAY.webp" id='title_img' alt="Logo" />
        </div>
        <div class="menu">
          <ul>
            
            <li><a href="myorders.php">My Orders</a></li>
            <li>
              <button onClick="location.href='shop.php'" class="blue-btn">
                Shop
              </button>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section id="hero">
      <div class="headtext">
        <h4>The new Favourite Candies!</h4>
        <h1>Best quality.</h1>
        <h1>Best delivery.</h1>
        <h1>Best security.</h1>
        <h5>Prices as low as € 0.95</h5>
      </div>

      <div class="img">
        <img src="powder_explotion_hero.png" alt="IMG" />
      </div>

      <div class="textboxes">
        <div class="textboxcontainer1">
          <div class="textbox"><p>Fresh from our factory.</p></div>
          <div class="textbox">
            <p>Constantly quality-checked by our experts.</p>
          </div>
        </div>
        <div class="textboxcontainer2">
          <div class="textbox"><p>Candy in its purest form.</p></div>
          <div class="textbox"><p>Delivery guaranteed within 5 days.</p></div>
        </div>
      </div>
    </section>

    <section id="newlineup">
      <div class="text">
        <h2>Our explosive new lineup.</h2>
        <h3>For the best Candy experience <br />Ever.</h3>
      </div>
      <div class="pills">
        <img src="Candyblue.png" alt="pill1" />
        <img src="CandyAlmond.png" alt="pill2" />
        <img src="oro_regaliz.png" alt="pill3" />
      </div>
      
      <button onClick="location.href='shop.php'" class="blue-btn">
        Shop now
        <i
          class="far fa-arrow-right"
          style="color: white; font-weight: bold"
        ></i>
      </button>
    </section>
    
    
  </body>
</html>
