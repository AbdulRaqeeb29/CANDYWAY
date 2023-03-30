<?php
    session_start();
    include "databse_conn.php";
    if(isset($_POST["uname"]) && !empty($_POST["uname"]) && !empty($_POST["psw"])){
        $username = $_POST["uname"];
        $password = $_POST["psw"];
        
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                $_SESSION['userid'] = $row['userid'];
                $start = time();
                $_SESSION['expire'] = $start + 1800;
                echo "<script>window.location.href ='home.php'</script>";
                exit();
            }
        }
        else{
            echo "<script>alert('Username or Password is incorrect!')</script>";
        }
    }
?>    



<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="1.css" />
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css"/>
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
    <div class="login_form">
        <form action="login.php" method="post">
            
        
            <div class="container">
            <h1>Login</h1>
            <hr style="margin-top:30px;">
            <label for="uname"><b></b></label>
            <input type="text" placeholder="Enter Username" name="uname" pattern="^\w*$" required>
        
            <label for="psw"><b></b></label>
            <input type="password" placeholder="Enter Password" name="psw" pattern="^.{6,15}$" required>
        
            <button type="submit" class="transparent-btn" >Login</button>
            
            </div>
        
            <div>
              <button type="button" class="cancelbtn" onclick="location.href='signup.php'"><a>Sign up</a></button>
            
            </div>
        </form>
    </div>
  </body>
</html>
              
    


