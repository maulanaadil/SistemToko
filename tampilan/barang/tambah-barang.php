<?php
require('../../functions.php');

$db = dbConnect();
    $kodeBarang = $db->escape_string($_POST['kodeBarang']);
    $namaBarang = $db->escape_string($_POST['namaBarang']);
    $harga = $db->escape_string($_POST['harga']);
    $stok = $db->escape_string($_POST['stok']);

    $sql = tambahBarang($kodeBarang,$namaBarang,$harga,$stok);
    $res = $db->query($sql);
    if ($db->affected_rows > 0) {
        echo 1;
    } else {
        echo 0;
    }
