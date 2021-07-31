<?php
require('../../functions.php');

$db = dbConnect();
        $kode_barang = dbConnect()->escape_string($_GET['id']);
        $sql = getHapusBarang($kode_barang); 

        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }