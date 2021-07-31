<?php
require('../../functions.php');

nav("Hapus Transaksi");

sidebar();
dbConnect();
?>

<body>
    <div class="content-wrapper">
    <?php
    if (isset($_GET['id_transaksi'])) {
        $id_transaksi = dbConnect()->escape_string($_GET['id_transaksi']);

        if ($dataHapus = getHapusTransaksi($id_transaksi)) {
    ?>
            <center>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Penghapusan selesai</p>
                    <a href="tampilan-transaksi.php" class="btn btn-primary">Kembali</a>
                </div>
            </center>
    <?php
        } else {
            echo "Kode transaksi tidak ditemukan";
        }
    } else {
        echo "<h1 align='center'>404 ERROR</h1>";
    }


    ?>
</body>

</html>