<?php
require('../../functions.php');

nav("Laporan Barang Kosong");

sidebar();
dbConnect();
 $data = getDataBarangKosong()->fetch_all(MYSQLI_ASSOC);
?>
<body>

<div class="content-wrapper">
    <div class="content-header"></div>
    <section class="content">
        <div class="row">
        <center>
        <h2>Laporan Data Barang Kosong</h2><br>
            <table class="table table-bordered table-striped"style="width: auto;">
                <thead>
                    <tr class="bg-dark text-white">
                        <td scope="col">Kode Barang</td>
                        <td scope="col">Nama Barang</td>
                        <td scope="col">Harga</td>
                        <td scope="col">Stok</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $row["kode_barang"]; ?></td>
                        <td><?= $row["nama_barang"]; ?></td>
                        <td><?= $row["harga"]; ?></td>
                        <td><?= $row["stok"]; ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </center>
        </div>
    </section>
</div>
</body>
</html>