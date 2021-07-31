<?php
require('../../functions.php');


dbConnect();

        $id_transaksi = dbConnect()->escape_string($_GET['id']);
        $sql = getHapusTransaksi($id_transaksi);
        

        if (mysqli_query($db, $sql)) {
            if ($db->affected_rows > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }