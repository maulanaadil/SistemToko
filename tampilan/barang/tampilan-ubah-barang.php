<?php
require('../../functions.php');

$kode = $_GET["kode_barang"];

$data = getDataBarang($kode)->fetch_assoc();

nav("Ubah Barang");

sidebar();
?>
<body>
<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-dark"> Ubah Barang</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="tampilan-barang.php">Barang</a></li>
                            <li class="breadcrumb-item active">Ubah Barang</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <div class="content-header">
            <a class="btn btn-app btn-primary" href="tampilan-barang.php">
                <i class="fa fa-th-list"></i> Lihat Data Barang
            </a>

            <div class="container-fluid mt-4" align="center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Form Ubah Barang</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group" align="left">
                                    <label for="exampleInputEmail1">Kode Barang</label>
                                    <input type="text" maxlength="4" class="form-control" id="text_kode_barang"
                                           placeholder="Masukan Kode Barang" value="<?= $data['kode_barang']; ?>" readonly>
                                </div>
                                <div class="form-group" align="left">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <input type="text" class="form-control" id="text_nama_barang"
                                           placeholder="Masukan Nama Barang" value="<?= $data['nama_barang']; ?>">
                                </div>
                                <div class="form-group" align="left">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input type="text" class="form-control" id="text_harga"
                                           placeholder="Masukan Harga Barang" value="<?= $data['harga']; ?>">
                                </div>
                                <div class="form-group" align="left">
                                    <label for="exampleInputEmail1">Stok</label>
                                    <input type="text" class="form-control" id="text_stok"
                                           placeholder="Masukan Stok Barang" required value="<?= $data['stok']; ?>">
                                </div>
                            </div>

                            <div class="card-footer" align="right">
                                <a href="tampilan-barang.php" class="btn btn-outline-secondary">Batal</a>
                                <button type="button" onclick="doSave()" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function doSave() {
        let kodeBarang = $("#text_kode_barang").val();
        let namaBarang = $("#text_nama_barang").val();
        let harga = $("#text_harga").val();
        let stok = $("#text_stok").val();
       
        if (kodeBarang == "") {
            swal.fire({
                title: "Error!",
                text: "Masukan Kode Barang!",
                icon: "error",
                button: "OK!",
            })
            return false;
        } else 
            if (namaBarang == "") {
                swal.fire({
                    title: "Error!",
                    text: "Masukan Nama Barang!",
                    icon: "error",
                    button: "OK!",
                })
                return false;
        } else if (harga == "") {
            swal.fire({
                    title: "Error!",
                    text: "Masukan Harga Barang!",
                    icon: "error",
                    button: "OK!",
                })
                return false;
        } else if (stok == "") {
            swal.fire({
                    title: "Error!",
                    text: "Masukan Stok Barang!",
                    icon: "error",
                    button: "OK!",
                })
                return false;
        }
        //  alert(stok); return false;

    $.ajax({
        data: "kodeBarang=" + kodeBarang + "&namaBarang=" + namaBarang + "&harga=" + harga + "&stok=" + stok,
        url: "ubah-barang.php",
        type: "POST",
        success: function(response) {
            if (response == 1) {
                swal.fire({
                        title: "Success!",
                        text: "Data Telah Diupdate!",
                        icon: "success",
                        button: "OK!",
                    })
                        .then((value) => {
                            location.href = "tampilan-barang.php";
                        });
            } else {
                swal.fire({
                        title: "Fail!",
                        text: "Data Gagal Diupdate!",
                        icon: "error",
                        button: "OK!",
                    })
                        .then((value) => {
                            location.reload();
                        });
            }
        },
    })
}
</script>