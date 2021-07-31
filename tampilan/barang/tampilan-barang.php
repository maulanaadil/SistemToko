<?php
require('../../functions.php');

dbConnect();

nav("Data Barang");

sidebar();
$data = getBarang()->fetch_all(MYSQLI_ASSOC);
?>

<body>
    <div class="content-wrapper">
    <div class="content-header"></div>
        <section class="content">
            <div class="container-fluid">
                <div align="center">
                    <h1>Data Barang</h1>
                </div>
                <div class="container">
                    <a class="btn btn-success" href="tampilan-tambah-barang.php">Tambah</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-4">
                            <tr class="bg-dark text-white" align="center">
                                <td width="20%">Kode Barang</td>
                                <td>Nama Barang</td>
                                <td>Harga</td>
                                <td>Stok</td>
                                <td width="20%">Aksi</td>
                            </tr>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $row['kode_barang']; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td><?= $row['harga']; ?></td>
                                    <td><?= $row['stok']; ?></td>
                                    <td align="center">
                                        <a href="tampilan-ubah-barang.php?kode_barang=<?= $row['kode_barang']; ?>" class="btn btn-primary">Ubah</a>
                                        <a href="tampilan-hapus-barang.php?kode_barang=<?= $row['kode_barang']; ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>