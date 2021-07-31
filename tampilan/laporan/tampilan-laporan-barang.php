<?php
require('../../functions.php');

nav("Laporan Barang Kosong");

sidebar();
dbConnect();
 $data = getDataBarangKosong()->fetch_all(MYSQLI_ASSOC);
 $dataTotal = getDataTotalBarangKosong()->fetch_array();
?>

<body>
    <div class="wrapper">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Laporan Barang Kosong</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                                <li class="breadcrumb-item active">Laporan</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>




            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Dibawah merupakan list data barang yang kosong.</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
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
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" style="text-align: center;">Total Barang Kosong</th>
                                                <td><?= $dataTotal[0]; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
            </section>
        </div>
</body>

</html>