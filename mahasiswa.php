<?php
session_start();
if(!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
  }
//koneksi ke database
include 'connect.php';


//cek udah di tekan submit atau belum
if (isset ($_POST["submit"])) {

//ambil data dari form
    $nama= htmlspecialchars($_POST['nama']);
    $nim=htmlspecialchars($_POST['nim']);
    $jurusan=htmlspecialchars($_POST['jurusan']);
    $jeniskelamin=htmlspecialchars($_POST['jeniskelamin']);
    $notelp=htmlspecialchars($_POST['notelp']);
    $tanggalmasuk=htmlspecialchars($_POST['tglmsk']);

//memindahkan data ke database
$query="INSERT INTO mahasiswa VALUES ('','$nim','$nama','$jurusan','$jeniskelamin','$notelp','$tanggalmasuk')";
mysqli_query($conn,$query);


//cek apakah data berhasil atau tidak
if(mysqli_affected_rows($conn) > 0 ) {
    echo "<script>
        alert('data berhasil dimasukkan!');
        document.location.href='index.php';
        </script>";

}
else {
    echo "<script>
        alert('data gagal dimasukkan!');
        document.location.href='index.php';
        </script>";
}
    echo mysqli_error($conn);
}



?>

<html>
<head>
    <title>Daftar Member Perpustakaan</title>
</head>
<body>
<h2 align="center">REGISTRASI MEMBER PERPUSTAKAAN</h2>
<form action="" name="mahasiswa" method="post">
    <table cellspacing="13" cellpadding="2" align="center">
    	<tr>
        <td>Nama: </td>
        <td><input type="text" name="nama" size="25" required> </td>
    </tr>
     <tr>
        <td>NIM: </td>
        <td><input type="text" name="nim" size="25" required> </td>
    </tr>
     <tr>
        <td>jurusan: </td>
        <td><select name="jurusan">
        	<option value="Manajemen Informatika">Manajemen Informatika</option>
        	<option value="Teknik Informatika">Teknik Informatika</option>
        	<option value="Sistem Informasi">Sistem Informasi</option>
        	<option value="Teknik Komputer">Teknik Komputer</option>
        </select>
        	 </td>
    </tr>
    <tr>
        <td>Jenis Kelamin: </td>
        <td><input type="radio" name="jeniskelamin" value="perempuan" required>Perempuan        <input type="radio" name='jeniskelamin' value="pria" required>Laki-laki </td>
    	
    </tr>
     <tr>
        <td>No Telp: </td>
        <td><input type="text" name="notelp" size="25" required> </td>
    </tr>
     <tr>
        <td>Tanggal Masuk: </td>
        <td><input type="date" name="tglmsk" size="25" required> </td>
    </tr>
 	<tr>
        <td><input type="submit" name="submit" value="Submit"> </button><input type="reset" value="Reset"> </td></td>
        
    </tr>
</table>
</form>
</body>
</html>