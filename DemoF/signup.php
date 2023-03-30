<?php
    
    include "databse_conn.php";
    if(!empty($_POST["email"])&& !empty($_POST["uname"]) && !empty($_POST["psw"]) && !empty($_POST["psw-repeat"])){
        $username = $_POST["uname"];
        $email = $_POST["email"];
        $password = $_POST["psw"];
        $password_rpt = $_POST["psw-repeat"];
        $userid = rand(100,999999);
        $sql = "SELECT * from user where email = '$email'";
        $result1 = mysqli_query($link, $sql);
        $sql = "SELECT * from user where username = '$username'";
        $result2 = mysqli_query($link, $sql);
        if($password==$password_rpt && !(mysqli_num_rows($result1)===1) && !(mysqli_num_rows($result2)===1)){
            $sql = "INSERT into user (username, email, password, userid) values('$username', '$email', '$password', '$userid')";
            $result = mysqli_query($link, $sql);
            if ($result){
                echo "<script>window.location.href ='login.php'</script>";
            }
            else{
                echo "<script>alert('Problem with inserting details')</script>";
            }
        }
        else{
            echo "<script>alert('Username or Email already exits!')</script>";
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
          <div class="title">
            <img src="CANDYWAY.webp" id='title_img' alt="Logo" onclick="location.href='home.php'" />
          </div>
        </div>
    </section>

    <div class="signup_form">
        <form action="signup.php" method="post">
    
        <div style="margin-top:20px;" class="container">
            <h1>Sign Up</h1>
            <p style="margin-top:30px;">Please fill in this form to create an account.</p>

            <hr>
        
            
            <label for="uname"><b></b></label>
            <input type="text" placeholder="Enter Username" name="uname" pattern="^\w*$" required>

            <label for="email"><b></b></label>
            <input type="text" placeholder="Enter Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
        
            <label for="psw"><b></b></label>
            <input type="password" placeholder="Enter Password" name="psw" pattern="^.{6,15}$" required>
        
            <label for="psw-repeat"><b></b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" pattern="^.{6,15}$" required>
            
                <button type="submit" class="transparent-btn">Sign Up</button>
            <div>
                <button type="button" class="cancelbtn" onclick="location.href='login.php'"><a>Login</a></button>
            </div>
        </div>   
        </form>
    </div> 
  </body>
</html>      