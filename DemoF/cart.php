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
  $sql = "SELECT * FROM cart_details join candies WHERE cart_details.userid='$id' AND cart_details.cand_id=candies.cand_id";
  $result = mysqli_query($link, $sql);
  if($result) {
    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
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
            
          </ul>
          
        </div>
      </div>
    </section>
    <section id="navbar">
      <div class="nav">
        <div class="pagenav"><a href="home.php">Home</a> > Cart</div>
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

    <div class="small-container_cart-page" style="color: white;">
        <table id="table1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php
              foreach($data as $row){?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <div class="img">
                            <img src="<?php echo $row['cand_img'];?>">
                            </div>
                            <div>
                                <p><?php echo $row['cand_name'];?></p>
                                <small>€ <?php echo $row['cand_price'];?></small>
                                <a href="remover_candies_cart.php?cand_id=<?php echo $row['cand_id'];?>">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $row['quantity'];?></td>
                    <td>€ <?php $subtotal= $subtotal+($row['cand_price']*$row['quantity']); echo $row['cand_price']*$row['quantity'];?></td>
                </tr>
              <?php }?>

        </table>

        <div style="margin-bottom: 30px" class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>€ <?php echo $subtotal;?></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>€ <?php echo round($subtotal*0.1, 2);?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>€ <?php $_SESSION['total_price'] = $subtotal+$subtotal*0.1; echo round($subtotal+$subtotal*0.1, 2);?></td>
                </tr>
                
            </table>
            
        </div>
        <section>
          <div>
            <button  onclick="location.href='payment.php'" class="transparent-btn">
              Proceed to Checkout
            </button>
            <?php if($subtotal == 0) {
              echo "<script>alert('No items in cart!')</script>";
              echo "<script>window.location.href ='shop.php'</script>";
              }
            ?> 
          </div>
        </section>

    </div>

    

</body>
</html>

