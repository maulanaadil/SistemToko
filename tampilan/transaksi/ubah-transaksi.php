<?php
session_start();
require('../../functions.php');

nav("Ubah Transaksi");
$db = dbConnect();
if (isset($_POST['tblSimpan'])) {
    $id_transaksi = $db->escape_string($_POST['idTransaksi']);
	$kode_barang = $db->escape_string($_POST['id']);
	$harga = $db->escape_string($_POST['harga']);
    $stok = $db->escape_string($_POST['stok']);
	$jumlah = $db->escape_string($_POST['jumlah']);
	
	$updateStok = ((int)$stok) - ((int)$jumlah);
	$updateTotal = ((int)$harga) * ((int)$jumlah);


    $sql = updateUbahBarang($kode_barang, $jumlah, $updateTotal, $updateStok, $id_transaksi);

    $res = $db->query($sql);

    if ($db->affected_rows > 0) {

        echo '<div class="alert alert-success" role="alert" align="center">
        <h4 class="alert-heading">Well done!</h4>
        <p>Berhasil Ubah Transaksi</p>
        <a href="tampilan-transaksi.php" class="btn btn-primary">Kembali</a>
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert" align="center">
                <h4 class="alert-heading">Warning!</h4>
                <p>Gagal Ubah Transaksi</p>
                <a href="javascript:history.back()" class="btn btn-danger">Kembali</a>
               </div>';
    }
}
