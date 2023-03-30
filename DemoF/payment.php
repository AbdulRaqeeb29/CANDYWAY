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
    $total_price = $_SESSION['total_price'];
    $id = $_SESSION['userid'];
    $sql = "SELECT * FROM cart_details WHERE userid = '$id'";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(isset($_POST['confirm_payment']) && !empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["email"]) && !empty($_POST["pincode"]) && !empty($_POST["phone"])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $sql = "SELECT  * from Payment where userid='$id'";
        $result = mysqli_query($link,$sql);
        if (mysqli_num_rows($result) >= 1) {
            $num_rows = mysqli_num_rows($result);
        }
        else{
            $num_rows = 0;
        }
        $trans_id = intval($id.strval(rand(100,999)).strval($num_rows));
        $phone = $_POST['phone'];
        $pincode = $_POST['pincode'];
        $sql1 = "INSERT INTO Payment (trans_id, userid, total_price, name, email, address, pincode, phone) VALUES ($trans_id, '$id', '$total_price', '$name', '$email', '$address', '$pincode', '$phone')";
        $result1 = mysqli_query($link, $sql1);
        if($result1){
            foreach($data as $row) {
                $cand_id = $row['cand_id'];
                $qnt_qnt = $row['quantity'];
                $sql = "INSERT INTO my_orders (trans_id, cand_id, qnt) VALUES ($trans_id,$cand_id,$qnt_qnt)";
                $trans_cand_id = mysqli_query($link, $sql);
                $sql = "SELECT total_candies FROM candies WHERE cand_id='$cand_id'";
                $result = mysqli_fetch_assoc(mysqli_query($link,$sql));
                $total_candies = $result['total_candies'];
                $total_candies =  intval($total_candies) - intval($qnt_qnt);
                $sql = "UPDATE candies SET total_candies = '$total_candies' WHERE cand_id='$cand_id'";
                mysqli_query($link, $sql);

            }
            
            $sql = "DELETE FROM cart_details WHERE userid = '$id'";
            $delete_result = mysqli_query($link, $sql);
            if($delete_result){
                echo "<script>alert('Order successfull will be delivered soon!')</script>";
                echo "<script>window.location.href ='home.php'</script>";
            }
        }
        else {
            echo 'some problem';
        }
    }

}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Form</title>
        <link href="1.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="1.css">
    </head>

    <body>
        <div class="wrapper">
            <h2 style="text-align:center; margin-bottom:20px;">Payment Form</h2>
            <form method="post">
                <h4>Account</h4>
                <div class="input-group">
                    <div style="margin-bottom: 10px" class="input-box">
                        <input type="text" placeholder="Full Name" name="name"required >
                        <i class="fa fa-user icon"></i>
                    </div>
                    <div style="margin-bottom: 10px" class="input-box">
                        <input type="text" placeholder="Address" name="address" required >
                        <i class="fa fa-user icon"></i>
                    </div>
                </div>
                <div style="margin-bottom: 10px" class="input-group">
                    <div class="input-box">
                        <input type="text" placeholder="Email Adress" name="email" required >
                        <i class="fa fa-envelope icon"></i>
                    </div>
                </div>

                <div style="margin-bottom: 10px" class="input-group">
                    <div class="input-box">
                        <input type="text" placeholder="Pincode" name="pincode" required >
                        <i class="fa fa-user icon"></i>
                    </div>
                </div>

                <div style="margin-bottom: 10px" class="input-group">
                    <div class="input-box">
                        <input type="text" placeholder="Phone" name="phone" required >
                        <i class="fa fa-user icon"></i>
                    </div>
                </div>
                
                
                <div>
                    <button style="width: 50%; margin-bottom: 20px" type='submit' class="transparent-btn" name='confirm_payment' >
                        CONFIRM 
                    </button>
                    <button style="width: 50%;" type='reset' class="transparent-btn" onclick="location.href='cart.php'">
                        BACK TO CART 
                    </button>
                </div>
                </div>
            </form>
        </div>
    </body>

</html>