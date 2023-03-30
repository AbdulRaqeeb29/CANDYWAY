<?php
    session_start();
    include "databse_conn.php";
    if(isset($_SESSION['userid'])){
        $id = $_SESSION['userid'];
        if(isset($_GET['cand_id'])){
            $c_ids = $_GET['cand_id'];
            $sql = "DELETE from cart_details where userid='$id' and cand_id=$c_ids";
            $result = mysqli_query($link,$sql);
            if($result){
                echo "<script>window.location.href ='cart.php'</script>";
            }
            else{
                echo "problem";
            }
        }
    }
    else{
        echo "<script>window.location.href ='login.php'</script>";
    }
?>