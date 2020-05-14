<?php
session_start();
  if(!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
  }
require 'connect.php';
$jumlahdataperhalaman= 2;
$totaldata=count(query("SELECT * FROM mahasiswa"));
$jumlahhalaman=ceil($totaldata/$jumlahdataperhalaman);

if(isset($_GET["halaman"])) {
$halamanaktif=$_GET["halaman"];
}
else {
$halamanaktif=1;
}

$awaldata=($jumlahdataperhalaman*$halamanaktif)-$jumlahdataperhalaman;
$mahasiswa=query("SELECT * FROM mahasiswa LIMIT $awaldata,$jumlahdataperhalaman");


//search
if(isset($_POST["cari"])) {
  $mahasiswa=cari($_POST["keyword"]);

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        h2 {
          /* margin-bottom: 40px auto;
          margin-top: 20px; */
          margin: 40px auto;
        }
        .logout {
          float: right;
          margin-top: 20px;
        }
        a {
            color: #4169E1 ;
            font-size: 17px;
        }
      
        a:hover {
            color: blue ; 
        }
        a:after{
            color:yellowgreen;
        }
        form {
          height: 70px;
          float: right;
          
        }
        .halamanaktif {
          color: red;
        }
    </style>
  </head>
      <body>
    <div id="init">
    <div class="container">
    <a href="logout.php" class="logout">Log Out</a>
    <br>
    <h2 align="center">Data Mahasiswa</h2>
        <form action="" method="POST" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" name="keyword" id="keyword" autofocus size="35" placeholder="Masukan keyword pencarian.." autocomplete="off">
        <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="cari" id="cari" value="Search" onclick="enter()">
        </form>
        <br>
        <a href="mahasiswa.php">Tambah Data Mahasiswa</a>
        <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">NIM</th>
        <th scope="col">Nama</th>
        <th scope="col">Jurusan</th>
        <th scope="col">Jenis Kelamin</th>  
        <th scope="col">No.Telp</th>
        <th scope="col">Tanggal Masuk</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
     <tbody>
      <?php $i=1; ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
          <tr>
            <th scope="row"><?= $i+$awaldata; ?></th>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["jurusan"]; ?></td>
            <td><?= $mhs["jeniskelamin"]; ?></td>
            <td><?= $mhs["notelp"]; ?></td>
            <td><?= $mhs["tglmsk"]; ?></td>
            <td><a href="edit.php? id=<?= $mhs["id"];?>" name='edit' class="btn btn-success">Edit</a>
      <a href="delete.php? id=<?= $mhs["id"];?>" class="btn btn-danger" onclick="return confirm('anda yakin?');">Delete</a></td>
          </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
      </table>
      <ul class="pagination">
      <li class="page-item">
      <?php if ( $halamanaktif != 1 ) :?>
      <a class="page-link" href="?halaman=1">&laquo;</a></li>
      <?php endif; ?>
      <li class="page-item">
      <?php if($halamanaktif >1) : ?>
      <a class="page-link" href="?halaman=<?= $halamanaktif -1 ?>">&lt;</a></li>
      <?php endif; ?>
      <li class="page-item">
      <?php for ($i=1 ; $i <= $jumlahhalaman; $i++) : ?>
        <?php if($i == $halamanaktif) : ?>
          <a class="page-link" href="?halaman=<?=$i; ?>" class="halamanaktif"><?= $i; ?></a></li>
            <?php else : ?>
          <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
        <li class="page-item">
        <?php if($halamanaktif <$jumlahhalaman) : ?>
      <a class="page-link" href="?halaman=<?= $halamanaktif + 1 ?>">&gt;</a></li>
      <?php endif; ?>
      <li class="page-item">
      <?php if ( $halamanaktif != $jumlahhalaman ) :?>
      <a class="page-link" href="?halaman=<?= $jumlahhalaman ?>">&raquo;</a></li>
      <?php endif; ?>
          </nav>
        </div>
      </div>
    <script src="js/script.js"></script>
  </body>
</html>