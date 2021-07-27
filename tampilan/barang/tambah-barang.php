<?php
require('../../functions.php');

nav("Tambah Barang");

if(isset($_POST['tblSimpan'])) {

    $db = dbConnect();
    $kodeBarang = $db->escape_string($_POST['kodeBarang']);
    $namaBarang = $db->escape_string($_POST['namaBarang']);
    $harga = $db->escape_string($_POST['harga']);
    $stok = $db->escape_string($_POST['stok']);

    $sql = "INSERT INTO barang
            VALUES ('$kodeBarang','$namaBarang','$harga','$stok')";

    $res = $db->query($sql);

    if ($db->affected_rows > 0) {

        echo 'Sukses';
    } else {
        echo 'Gagal';
    }
}



?>