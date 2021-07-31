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
                <tr class="bg-dark text-white" align="center">
                    <td width="20%">Nama Kasir</td>
					<td>Id Transaksi</td>
                    <td>Nama Barang</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
					<td>Total</td>
                    <td width="20%">Aksi</td>
                </tr>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $row['nama_pegawai']; ?></td>
						<td><?= $row['id_transaksi']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['harga']; ?></td>
                        <td><?= $row['jml_beli']; ?></td>
						<td><?= $row['total']; ?></td>
                        <td align="center">
                            <a href="tampilan-ubah-transaksi.php?id_transaksi=<?= $row['id_transaksi']; ?>" class="btn btn-primary">Ubah</a>
                            <a href="hapus-transaksi.php?id_transaksi=<?= $row['id_transaksi']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</body>