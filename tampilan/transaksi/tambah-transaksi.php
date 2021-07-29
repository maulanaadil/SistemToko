<?php
session_start();
require('../../functions.php');

nav("Tambah Transaksi");
$db = dbConnect();
if(isset($_POST['tblSimpan'])) {
    $kodeBarang = $db->escape_string($_POST['id']);
    $jumlahBarang = $db->escape_string($_POST['jumlah']);
    $harga = $db->escape_string($_POST['harga']);
	$total = ((int)$harga) * ((int)$jumlahBarang);
	$tanggalTransaksi=date('Y-m-d');
	$id_pegawai = $_SESSION["id_pegawai"];
	
	$sqll = tambahTransaksi($id_pegawai, $tanggalTransaksi);
	$ress = $db->query($sqll);

    $sql = tambahDetailTransaksi($kodeBarang,$jumlahBarang,$total);
    $res = $db->query($sql);
	
	

    if ($db->affected_rows > 0) {

        echo '<div class="alert alert-success" role="alert" align="center">
        <h4 class="alert-heading">Well done!</h4>
        <p>Berhasil Menambahkan Transaksi</p>
        <a href="tampilan-transaksi.php" class="btn btn-primary">Kembali</a>
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert" align="center">
                <h4 class="alert-heading">Warning!</h4>
                <p>Gagal Tambah Barang, Cek Kembali ID Menu</p>
                <a href="javascript:history.back()" class="btn btn-danger">Kembali</a>
               </div>';
    }
}
