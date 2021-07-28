<?php
require('../../functions.php');

$kode = $_GET["kode_barang"];

$data = getDataBarang($kode)->fetch_assoc();

nav("Ubah Barang");
?>

<body>
    <div class="container-fluid mt-4" align="center">
        <h1>Ubah Barang</h1>
        <form action="ubah-barang.php" method="POST" class="mt-5">
            <input type="hidden" name="kodeDulu" value="<?= $kode; ?>">
            <table class="table-sm">
                <tr>
                    <td width="25%">Kode Barang</td>
                    <td width="50%"><input type="text" name="kodeBarang" class="form-control" required value="<?= $data['kode_barang'];; ?>"></td>
                </tr>
                <tr>
                    <td width="25%">Nama Barang</td>
                    <td width="50%"><input type="text" name="namaBarang" class="form-control" required value="<?= $data['nama_barang']; ?>"></td>
                </tr>
                <tr>
                    <td width="25%">Harga</td>
                    <td width="50%"><input type="number" name="harga" class="form-control" required value="<?= $data['harga']; ?>"></td>
                </tr>
                <tr>
                    <td width="25%">Stok</td>
                    <td width="50%"><input type="number" name="stok" class="form-control" required value="<?= $data['stok']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right">
                        <a href="tampilan-barang.php" class="btn btn-secondary">Batal</a>
                        <input type="submit" name="tblSimpan" value="Simpan" class="btn btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>