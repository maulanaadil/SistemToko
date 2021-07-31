<?php
session_start();
require('../../functions.php');

dbConnect();

nav("Transaksi");
$data = getDataTransaksi()->fetch_all(MYSQLI_ASSOC);
?>

<body>
    <div class="mt-4" align="center">
        <h1>Data Transaksi</h1>
    </div>
    <div class="container">
        <a class="btn btn-success" href="tampilan-tambah-transaksi.php">Tambah</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-4">
                <thead align="center">
                    <th width="20%">Nama Kasir</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th width="20%">Aksi</th>
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
                            <a href="hapus-transaksi.php?id_transaksi=<?= $row['it']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
