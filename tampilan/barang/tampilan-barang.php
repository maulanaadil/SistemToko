<?php
require('../../functions.php');

dbConnect();

nav("Data Barang");

sidebar();
$data = getBarang()->fetch_all(MYSQLI_ASSOC);
$dataTotal = getTotalBarang()->fetch_array(MYSQLI_NUM);
?>

<body>

    <!-- HEADER -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <p class="h3">Tampilan Barang</p>

                    </div><!-- /.col -->


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.container-fluid -->
            </div>
        </div> <!-- /. content-header -->

        <!-- BODY -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <span class="fa-pull-right">
                        <a class="btn btn-app btn-primary" href="tampilan-tambah-barang.php">
                            <i class="fas fa-plus"></i>Tambah barang
                        </a>
                    </span>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <p class="h5" style="text-align: end;">Total Barang : <?= $dataTotal[0] ?></p>
                            
                                <div class="card-body table-responsive p-0">

                                    <div class="table table-hover text-nowrap table-sm table-striped">
                                        <table class="table table-hover text-nowrap table-sm table-striped">
                                            <thead align="center">
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </thead>

                                            <tbody>

                                                <?php foreach ($data as $row) : ?>
                                                <tr>
                                                    <td><?= $row['kode_barang']; ?></td>
                                                    <td><?= $row['nama_barang']; ?></td>
                                                    <td><?= $row['harga']; ?></td>
                                                    <td><?= $row['stok']; ?></td>
                                                    <td align="center">
                                                        <a href="tampilan-ubah-barang.php?kode_barang=<?= $row['kode_barang']; ?>"
                                                            class="btn btn-primary"><i
                                                                class="fa fa-edit">&nbsp;</i>Ubah</a>
                                                        <button onclick="doDelete('<?= $row['kode_barang']; ?>')"
                                                            class="btn btn-danger"><i
                                                                class="fa fa-trash">&nbsp;</i>Hapus</button>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
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

                    $.ajax({
                        data: "id=" + id,
                        url: "tampilan-hapus-barang.php",

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