<?php
require('../../functions.php');

dbConnect();

nav("Tambah Barang");

sidebar();
?>

<body>
    <div class="content-wrapper">
    <div class="content-header"></div>
        <div class="container-fluid mt-4" align="center">
            <h1>Tambah Barang</h1>
            <form action="tambah-barang.php" method="POST" class="mt-5" enctype="multipart/form-data">
                <table class="table-sm">
                    <tr>
                        <td width="25%">Kode Barang</td>
                        <td width="50%"><input type="text" name="kodeBarang" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Barang</td>
                        <td width="50%"><input type="text" name="namaBarang" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td width="25%">Harga</td>
                        <td width="50%"><input type="number" name="harga" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td width="25%">Stok</td>
                        <td width="50%"><input type="number" name="stok" class="form-control" required></td>
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
    </div>
</body>