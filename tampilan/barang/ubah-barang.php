<?php
require('../../functions.php');

nav("Tambah Barang");
$db = dbConnect();
if (isset($_POST['tblSimpan'])) {
    $kodeDulu = $db->escape_string($_POST['kodeDulu']);
    $kodeBarang = $db->escape_string($_POST['kodeBarang']);
    $namaBarang = $db->escape_string($_POST['namaBarang']);
    $harga = $db->escape_string($_POST['harga']);
    $stok = $db->escape_string($_POST['stok']);

    $sql = ubahBarang($kodeDulu, $kodeBarang, $namaBarang, $harga, $stok);

    $res = $db->query($sql);

    if ($db->affected_rows > 0) {

        echo '<div class="alert alert-success" role="alert" align="center">
        <h4 class="alert-heading">Well done!</h4>
        <p>Berhasil Ubah Barang</p>
        <a href="tampilan-barang.php" class="btn btn-primary">Kembali</a>
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert" align="center">
                <h4 class="alert-heading">Warning!</h4>
                <p>Gagal Ubah Barang, Cek Kembali!</p>
                <a href="javascript:history.back()" class="btn btn-danger">Kembali</a>
               </div>';
    }
}
