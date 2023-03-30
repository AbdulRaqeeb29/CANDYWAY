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
if(!isset($_SESSION['userid'])) {
  echo "<script>window.location.href ='login.php'</script>";
}
else {
  $id = $_SESSION['userid'];
  $subtotal = 0;
  $sql = "SELECT * FROM Payment where userid='$id'";
  $result = mysqli_query($link, $sql);
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
            
        </div>
      </div>
    </section>
    <section id="navbar">
      <div class="nav">
        <div class="pagenav"><a href="home.php">Home</a> > MyOrders</div>
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

    <div class="small-container_cart-page" style="color: white;">
        <table id="table1">
            <tr>
                <th>transaction id</th>
                <th>total candies</th>
                <th>total price</th>
            </tr>
            <?php 
                if($result) {
                    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
                    foreach($data as $row){?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <div>
                                <p><?php echo $row['trans_id'];?></p>
                                <p><?php echo $row['timestamp'];?></p>
                            </div>
                        </div>
                    </td>
                    <?php
                        $trans_id = $row['trans_id'];
                        $sql = "SELECT * from my_orders where trans_id=$trans_id"; 
                        $trans_candies_numbers = mysqli_num_rows(mysqli_query($link,$sql));?>
                    <td><p><?php echo $trans_candies_numbers;?></p></td>
                    <td>€ <?php echo round($row['total_price'], 2);?></td>
                </tr>
              <?php } }?>

        </table>

    </div>

<script>

</script>

    

</body>
</html>

