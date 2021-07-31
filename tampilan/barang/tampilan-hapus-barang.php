<?php
require('../../functions.php');

nav("Hapus Barang");

sidebar();
dbConnect();
?>

<body>
    <div class="content-wrapper">
    <?php
    if (isset($_GET['kode_barang'])) {
        $kode_barang = dbConnect()->escape_string($_GET['kode_barang']);

        if ($dataHapus = getHapusBarang($kode_barang)) {
    ?>
            <center>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Penghapusan selesai</p>
                    <a href="tampilan-barang.php" class="btn btn-primary">Kembali</a>
                </div>
            </center>
    <?php
        } else {
            echo "Kode Barang tidak ditemukan";
        }
    } else {
        echo "<h1 align='center'>404 ERROR</h1>";
    }


    ?>
</body>

</html>