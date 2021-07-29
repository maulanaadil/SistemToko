<?php
require ('../../functions.php');
$db = dbConnect();
$query = mysqli_query($db, "SELECT * FROM barang WHERE kode_barang='$_GET[id]'");
$barang = mysqli_fetch_array($query);
$data = array('harga' => $barang['harga'],'stok' => $barang['stok']);
      echo json_encode($data);
 ?>