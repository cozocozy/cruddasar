<?php 
	$conn = mysqli_connect('localhost','root','') or die ("koneksi gagal");
	mysqli_select_db($conn,'perpustakaan') or die ("database tdk ada");

//select
	function query($query) {
		global $conn;
		$result = mysqli_query($conn,$query);
		$rows=[];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[]= $row;
		}
		return $rows;
	}
//hapus	
	function hapus($id) {
		global $conn;
		mysqli_query($conn,"DELETE FROM mahasiswa WHERE id=$id");
		return mysqli_affected_rows($conn);	
	}

//cari
	function cari($keyword) {
		$query = "SELECT * FROM MAHASISWA WHERE 
				nim LIKE '%$keyword%' OR
				nama LIKE '%$keyword%' OR
				jurusan LIKE '%$keyword%' OR
				jeniskelamin LIKE '%$keyword%' OR
				notelp LIKE '%$keyword%' OR
				tglmsk LIKE '%$keyword%'
				";
	return query($query);
	}

// registrasi
	function registrasi($data) {
		global $conn;
		$username= strtolower(stripslashes($data["username"]));
		$password=mysqli_real_escape_string($conn,$data["password"]);
		$password2=mysqli_real_escape_string($conn,$data["password2"]);
		$email=(stripslashes($data["email"]));
		
		//cek username 
		$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
		if(mysqli_fetch_assoc($result)) {
			echo "<script>
        alert('user telah terdaftar!');
		</script>";
		return false;
		}
		//cek perbedaan password
		if($password !== $password2) {
			echo "<script>
        alert('password tidak sesuai!');
		</script>";
		return false;
		}

		//enkripsi password
		$password = password_hash($password,PASSWORD_DEFAULT);
		//masukan user baru ke database
		mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password','$email')");
		return mysqli_affected_rows($conn);
	}
 ?>
