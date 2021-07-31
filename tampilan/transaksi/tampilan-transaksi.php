<?php
require('../../functions.php');

dbConnect();

nav("Transaksi");

sidebar();
$data = getDataTransaksi()->fetch_all(MYSQLI_ASSOC);
?>

<body>
    <div class="content-wrapper">
    <div class="content-header"></div>
    <section class="content">
    <div align="center">
        <h1>Data Transaksi</h1>
    </div>
    <div class="container">
        <a class="btn btn-success" href="tampilan-tambah-transaksi.php">Tambah</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-4" >
                <thead align="center" class="bg-dark text-white">
                    <td width="20%">Nama Kasir</td>
                    <td>Tanggal</td>
                    <td>Nama Barang</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Total</td>
                    <td width="20%">Aksi</td>
                </thead>
                <tbody>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $row['np']; ?></td>
                        <td><?= $row['it']; ?></td>
                        <td><?= $row['nb']; ?></td>
                        <td><?= $row['h']; ?></td>
                        <td><?= $row['jt']; ?></td>
                        <td><?= $row['t']; ?></td>
                        <td align="center">
                            <a href="tampilan-ubah-transaksi.php?id_transaksi=<?= $row['it']; ?>" class="btn btn-primary">Ubah</a>
                            <a href="hapus-transaksi.php?id_transaksi=<?= $row['it']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
