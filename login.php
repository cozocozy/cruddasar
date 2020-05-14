<?php
session_start();
require 'connect.php';
//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];
   $result= mysqli_query($conn,"SELECT username FROM user WHERE id=$id");
   $row = mysqli_fetch_assoc($result);

   if($key === hash('sha256',$row['username'])) {
       $_SESSION['login'] = true;
   }
    }
if(isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
  }

if(isset($_POST['login'])) {
    $username=$_POST["username"];
    $password=$_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username= '$username'");

    //cek user
    if(mysqli_num_rows($result) === 1 ) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password,$row["password"])) {
            //set session
            $_SESSION["login"]= true;
            //cek remember
            if(isset($_POST['remember'])) {
                //create cookie
                setcookie('id',$row['id'],time()+1800);
                setcookie('key',hash('sha256',$row['username'],time()+1800));
            }
            header("Location:index.php");
            exit;
        }   
    }
    $error= true;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <style>
        p {
            margin-top: 20px;
            margin-bottom: 0;
        }
        td,tr {
            display: block;
            margin: 10px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h2 align="center">LOGIN</h2>
    <?php if(isset($error)) : ?>
        <p style="color:red; font-style:italic; text-align:center;">username / password salah</p>
    <?php endif; ?>
    <form action="" method="POST">
    <table class="table table-light" cellspacing="13" cellpadding="2" align="center">
    <tr><td>Username</td><td><input type="text" name="username" autofocus autocomplete="off"></td>
    </tr>
    <tr>
        <td>Password</td><td><input type="password" name="password"></td>
    </tr>
        <tr>
            <td style="font-size:15px;"><input type="checkbox" name="remember">ingatkan saya?</td> 
        </tr>
    <tr>
        <td><input type="submit" name="login" value="login"> <a href="" style="font-size: 15px;">lupa password?</a></td>
    </tr>
    </table>
    </form>
</body>
</html>