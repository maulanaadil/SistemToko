<?php
require('../../functions.php');

dbConnect();

nav("Transaksi");

sidebar();
$data = getDataTransaksi()->fetch_all(MYSQLI_ASSOC);
$dataTotal = getTotalTransaksi()->fetch_array();
?>

<body>

    <!-- HEADER -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <p class="h3">Tampilan Transaksi</p>

                    </div><!-- /.col -->


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.container-fluid -->
            </div>
        </div> <!-- /. content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <span class="fa-pull-right">
                        <a class="btn btn-app btn-primary" href="tampilan-tambah-transaksi.php">
                            <i class="fas fa-plus"></i>Tambah Transaksi
                        </a>
                    </span>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <p class="h5" style="text-align: end;">Total Transaksi : <?= $dataTotal[0] ?></p>
                            
                                <div class="card-body table-responsive p-0">

                                    <div class="table table-hover text-nowrap table-sm table-striped">
                                        <table class="table table-hover text-nowrap table-sm table-striped">
                                            <thead align="center">
                                                <th>Nama Kasir</th>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </thead>

                                            <tbody>
                                            <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <td><?= $row['np']; ?></td>
                                                <td><?= $row['tgl']; ?></td>
                                                <td><?= $row['nb']; ?></td>
                                                <td><?= $row['h']; ?></td>
                                                <td><?= $row['jt']; ?></td>
                                                <td><?= $row['t']; ?></td>
                                                <td align="center">
                                                    <button class="btn btn-danger" onclick="doDelete(<?= $row['it']; ?>)"><i class="fa fa-trash">&nbsp;</i>Hapus</button>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</body>
<script>
    // TODO: Masih ada bug di bagian delete data transaksi. mungkin bermasalh di databasenya.
function doDelete(id) {
        swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Ketika anda menghapus data ini, data tidak bisa direcovery!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    // alert(id);return false; 

                    $.ajax({
                        data: "id=" + id,
                        url: "hapus-transaksi.php",

                        success: function (response) {
                            if (response == 1) {
                                swal.fire({
                                        title: "Success!",
                                        text: "Berhasil menghapus data!",
                                        icon: "success",
                                        button: "Aww yiss!",
                                    })
                                    .then((value) => {
                                        location.reload();
                                    });

                            } else {
                                swal.fire({
                                        title: "Failed!",
                                        text: "Gagal menghapus data!",
                                        icon: "error",
                                        button: "OK!",
                                    })
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        }
                    })
                } else {
                    swal.fire("Data tidak jadi dihapus!");
                }
            });
    }
</script>
