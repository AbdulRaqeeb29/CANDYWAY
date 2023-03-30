<?php
session_start();
include "databse_conn.php";
$userid = $_SESSION['userid'];
$cand_id = $_GET['cand_id'];
$quantity = $_GET['quantity'];
$sql = "SELECT total_candies FROM candies WHERE cand_id='$cand_id'";
$result = mysqli_fetch_assoc(mysqli_query($link,$sql));
$candies_tot = $result['total_candies'];
if(!($candies_tot>$quantity)){
    $check = $candies_tot-1;
    echo "<script>alert('Only $check in stock')</script>";
    echo "<script>window.location.href ='shop.php'</script>";
}
else{
$sql = "SELECT * FROM cart_details WHERE userid='$userid' AND cand_id='$cand_id'";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result)==1){
    $qnt = mysqli_fetch_assoc($result)['quantity'];
    if((($qnt+$quantity)>10)||((($qnt+$quantity)>($candies_tot-1)))){
        echo "<script>alert('Limit reached!')</script>";
        echo "<script>window.location.href ='shop.php'</script>";
    }
    else{
        $quantity = $qnt+$quantity;
        $sql = "UPDATE cart_details SET quantity = '$quantity' WHERE cand_id='$cand_id' AND userid='$userid'";
        mysqli_query($link, $sql);
        echo "<script>window.location.href ='shop.php'</script>";
    }
}
else{
    $sql = "INSERT INTO cart_details(userid, cand_id, quantity) VALUES ('$userid','$cand_id','$quantity')";
    mysqli_query($link, $sql);
    echo "<script>window.location.href ='shop.php'</script>";
}
}
?>