<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include_once("functions.php");
$db = dbConnect();
 
// menangkap data yang dikirim dari form login
$id_pegawai = $_POST['id_pegawai'];
$password = $_POST['password'];
$id_pegawai = mysqli_real_escape_string($db, $_POST['id_pegawai']);
$password = mysqli_real_escape_string($db, $_POST['password']);
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($db,"select * from pegawai where id_pegawai='$id_pegawai'
and pass='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0)
{
 
	$data = mysqli_fetch_assoc($login);

		// buat session
		$_SESSION["id_pegawai"] = $data["id_pegawai"];
		$_SESSION["nama_pegawai"] = $data["nama_pegawai"];
		$_SESSION["jabatan"] = $data["jabatan"];
		// alihkan ke halaman dashboard admin
		header("location:tampilan/barang/tampilan-barang.php");

}else
{   //alihkan ke index
	header("location:index.php?error=1");
}
 
?>
