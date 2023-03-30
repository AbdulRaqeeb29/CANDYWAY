<?php 
session_start();
$current_time = time();
if(isset($_SESSION['userid'])) {
  if($current_time > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    echo "<script>window.location.href ='home.php'</script>";
}

}
include "databse_conn.php";
$id = $_SESSION['userid'];
$sql = "SELECT * from candies";
$result = mysqli_query($link,$sql);
if($result){
  $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
}else{
  echo "<script>alert('Problem with the site settings')</script>";
  echo "<script>windows.location.href='home.php'</script>";
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
        <div class="menu">
          <ul class="nav-menu">
            <li><a href="home.php">Home</a></li>            
            
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
              <span class="material-symbols-outlined" id="cart_count_with_symbol" style="font-size:28px;"> 
                shopping_bag
                <?php if(isset($_SESSION['userid'])) {?>
                <div class="cart_quant" id="cart_int_qnt" style="padding-top: 2px;">
                <?php 
                  $sql = "SELECT COUNT(*) AS total_count from cart_details WHERE userid='$id'";
                  $result_to_count = mysqli_query($link,$sql);
                  $data_to_count = mysqli_fetch_assoc($result_to_count);
                  echo $data_to_count['total_count'];
                ?>
                </div>
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
        <div class="pagenav"><a href="home.php">Home</a> > Shop</div>
        <div class="menu">
          <ul>
            
            <li><a href="myorders.php">My Orders</a></li>
            
          </ul>
        </div>
      </div>
    </section>

    <section id="shop-category">
      <div class="container">
        <div class="cattitle">CANDY</div>
        <div class="itemcards">
          <?php foreach($data as $row){?>
            <div class="card">
              <div class="img">
                <img
                  src="<?php echo $row['cand_img'];?>"
                  alt="PRODUCT_IMG"
                />
                <div class="rating">
                  <p>User rating:</p>
                  <div class="stars">
                    <?php for($i=0;$i<$row['user_rating'];$i++){?>
                    <i class="fas fa-star"></i>
                    <?php }?>
                  </div>
                </div>
              </div>
              <div class="prodinf">
                <div class="info">
                  <div class="title"><?php echo $row['cand_name'];?></div>
                  <div class="desc"><?php echo $row['unit'];?> UNIT</div>
                  <div class="price">€ <?php echo $row['cand_price'];?></div>
                  <?php
                  if($row['total_candies'] >= 2 && $row['total_candies'] < 6) {?>
                    <div class="price1" style="color:red">Only <?php echo ($row['total_candies']-1);?> remaining!</div>
                  <?php }?>
                  <?php
                  if($row['total_candies'] < 2) {?>
                    <div class="price1" style="color:red">Out of stock!</div>
                  <?php }?>
                  
                </div>
                <div class="options">
                  <div class="amount">
                    <button onclick="minus(<?php echo $row['cand_id'];?>)"><i class="fas fa-minus"></i></button>
                    <p id="value<?php echo $row['cand_id'];?>">1</p>
                    <button onclick="plus(<?php echo $row['cand_id'];?>)"><i class="fas fa-plus"></i></button>
                  </div>
                  <button onclick="cartdbs(<?php echo $row['cand_id'];?>)" class="add-to-cart">Add to cart</button>
                </div>
              </div>
            </div>
          <?php }?>
        </div>
      </div>
    </section>

    
  </body>

  <script>
    window.onload = function() {
      var cart_qnt_int =   document.getElementById('cart_int_qnt').innerHTML;
      if(cart_qnt_int > 0){
          document.getElementById("cart_count_with_symbol").animate(
            [
              // keyframes
              { transform: "translateX(6px)" },
              { transform: "translateX(-4px)" },
              { transform: "translateX(6px)" },
              { transform: "translateX(-4px)" },
              { transform: "translateX(2px)" },
              { transform: "translateX(0)" },
            ],
            {
              // timing options
              duration: 700,
              iterations: 1,

            }
          );
        }
  }
    function minus(cid){
      var changes = 'value'.concat(cid);
      var c_value = document.getElementById(changes).innerHTML;
      if(c_value > 1){
        document.getElementById(changes).innerHTML = parseInt(c_value)-1;
      }
    }
    function plus(cid){
      var changes = 'value'.concat(cid);
      var c_value = document.getElementById(changes).innerHTML;
      if(c_value < 10){
      document.getElementById(changes).innerHTML = parseInt(c_value) + 1;
      }
    }
    function cartdbs(cid){
      var changes = 'value'.concat(cid);
      var qnt = document.getElementById(changes).innerHTML;
      window.location.href="cartdb.php?cand_id="+cid+"&quantity="+qnt;
    }
  </script>
</html>

