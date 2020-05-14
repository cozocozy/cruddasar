<?php
session_start();
if(!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
  }
require 'connect.php';

if(isset($_POST["submit"])) {
    if(registrasi($_POST) > 0) {
        echo "<script>
        alert('user berhasil di tambah!');
        </script>";
    }
    else {
        echo mysqli_error($conn);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasi</title>
    <style>
        td,tr {
            display: block;
            margin: 10px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h2 align="center">REGISTRASI</h2>
    <form action="" method="POST">
    <table class="table table-light" cellspacing="13" cellpadding="2" align="center">
        <tbody>
            <tr>
            <td>Username</td><td><input type="text" name="username" size="30px" autofocus autocomplete="off"></td>
            </tr>
            <tr>
            <td>password</td><td><input type="password" name="password" size="30px" ></td>
            </tr>
            <tr>
            <td>konfirmasi password</td><td><input type="password" name="password2" size="30px"></td>
            </tr>
            <tr>
            <td>email</td><td><input type="text" name="email" size="30px" autocomplete="off"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit"></td>
            </tr>
        </tbody>
    </table>
    </form>
</body>
</html>