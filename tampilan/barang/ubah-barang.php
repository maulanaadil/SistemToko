<?php
require('../../functions.php');

// nav("Tambah Barang");
$db = dbConnect();
    $kodeBarang = $db->escape_string($_POST['kodeBarang']);
    $namaBarang = $db->escape_string($_POST['namaBarang']);
    $harga = $db->escape_string($_POST['harga']);
    $stok = $db->escape_string($_POST['stok']);

    $sql = ubahBarang($kodeBarang, $namaBarang, $harga, $stok);

    if (mysqli_query($db, $sql)) {
        if ($db->affected_rows > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
