<?php
require('../../functions.php');

nav("Laporan Barang Kosong");
dbConnect();
 $data = getDataBarangKosong()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Kosong</title>
</head>
<body>
<h5>Laporan Data Barang Kosong</h5>
<div class="row mt-3">
<center>
    <table class="table table-bordered" style="width: auto;">
        <thead>
            <tr>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) : ?>
            <tr>
                <th><?= $row["kode_barang"]; ?></th>
                <td><?= $row["nama_barang"]; ?></td>
                <td><?= $row["harga"]; ?></td>
                <td><?= $row["stok"]; ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</center>
</div>
</body>
</html>