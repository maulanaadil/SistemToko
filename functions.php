<?php

function dbConnect()
{
  $db = new mysqli("localhost", "root", "", "db_toko");
  return $db;
}

function showError($message)
	{ ?>
	<div class="alert alert-danger" role="alert">
	<?php echo $message; ?>
	</div>
<?php
}

// function untuk query menambah data ke tabel barang
function tambahBarang($kodeBarang, $namaBarang, $harga, $stok)
{
  return "INSERT INTO barang(kode_barang, nama_barang, harga, stok) VALUES ('$kodeBarang', '$namaBarang', '$harga', '$stok') ";
}

function ubahBarang($kodeDulu, $kodeBarang, $namaBarang, $harga, $stok)
{
  return "UPDATE barang SET kode_barang = '$kodeBarang', nama_barang='$namaBarang', harga='$harga', stok='$stok'
          WHERE kode_barang = '$kodeDulu'";
}

function getHapusBarang($kode_barang)
{
  $db = dbConnect();

  $sql = "DELETE FROM barang WHERE kode_barang = '$kode_barang'";
  return $delete = $db->query($sql);

  if ($delete) {
    mysqli_close($db);
    header("location: tampilan-barang.php");
    exit;
  } else {
    echo "Penghapusan menu gagal";
  }
}

function getBarang()
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang";
  return $db->query($sql);
}

//function untuk query mengambil data barang untuk form edit barang
function getDataBarang($kode)
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang WHERE kode_barang = '$kode'";
  return $db->query($sql);
}

//function untuk query mengambil data barang yang stok=0
function getDataBarangKosong()
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang WHERE stok=0";
  return $db->query($sql);
}

//function untuk ambil data barang berdasarkan namaBarang
function getShowBarang()
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang ORDER BY nama_barang";
  return $db->query($sql);
}
//function untuk menampilkan data barang berdasarkan id_barang
function getShowSelectedBarang()
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang WHERE kode_barang='$_GET[id]'";
  return $db->query($sql);
}

//function insert data transaksi ke database
function tambahTransaksi($idPegawai, $tanggalTransaksi, $jumlahTransaksi, $total)
{
  return "INSERT INTO transaksi (id_pegawai, tgl_transaksi, jumlah_transaksi, total) VALUES ('$idPegawai', '$tanggalTransaksi', '$jumlahTransaksi', '$total')";
}

//function insert detail transaksi ke database
function tambahDetailTransaksi($idTransaksi, $kodeBarang, $jmlBeli)
{
  return "INSERT INTO detail_transaksi(id_transaksi, kode_barang, jml_beli) VALUES ('$idTransaksi', '$kodeBarang', '$jmlBeli')";
}

//function query update stok barang
function updateStokBarang($kodeBarang, $stok) {
  return "UPDATE barang SET stok = stok - '$stok' WHERE kode_barang = '$kodeBarang' ";
}

//function untuk ambil data data transaksi
function getDataTransaksi()
{
  $db = dbConnect();
  $sql = 'SELECT pegawai.nama_pegawai as np, transaksi.tgl_transaksi as it, barang.nama_barang as nb, barang.harga as h, transaksi.jumlah_transaksi as jt, transaksi.total as t 
FROM pegawai
INNER JOIN 
transaksi ON transaksi.id_pegawai = pegawai.id_pegawai
INNER JOIN 
detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi
INNER JOIN 
barang  ON detail_transaksi.kode_barang = barang.kode_barang
ORDER BY transaksi.id_transaksi;';
  return $db->query($sql);
}

//function untuk ambil data data transaksi dan update
function getDataTransaksiUpdate($id)
{
  $db = dbConnect();
  $sql = "SELECT * FROM pegawai NATURAL JOIN transaksi NATURAL JOIN detail_transaksi
				 NATURAL JOIN barang WHERE id_transaksi='$id'";
  return $db->query($sql);
}

//function update data barang ketika insert transaksi
// function updateStokBarang($kodeBarang)
// {
//   return "UPDATE barang, detail_transaksi SET barang.stok = barang.stok - detail_transaksi.jml_beli
// 				 WHERE barang.kode_barang = detail_transaksi.kode_barang and detail_transaksi.kode_barang='$kodeBarang'";
// }

//function update ubah barang
function updateUbahBarang($kode_barang, $jumlah, $updateTotal, $updateStok, $id_transaksi)
{
  return "UPDATE detail_transaksi, barang SET detail_transaksi.kode_barang='$kode_barang',
				  detail_transaksi.jml_beli='$jumlah', detail_transaksi.total='$updateTotal', 
				  barang.stok='$updateStok' WHERE detail_transaksi.kode_barang=barang.kode_barang
				  AND detail_transaksi.id_transaksi='$id_transaksi'";
}

//function hapus transaksi
function getHapusTransaksi($id_transaksi)
{
  $db = dbConnect();

  $sql = "DELETE transaksi.*, detail_transaksi.* FROM transaksi, detail_transaksi WHERE transaksi.id_transaksi = detail_transaksi.id_transaksi
					  AND transaksi.id_transaksi = '$id_transaksi'";
  return $delete = $db->query($sql);

  if ($delete) {
    mysqli_close($db);
	header("location: tampilan-barang.php");
    exit;
  } else {
    echo "Penghapusan Transaksi Gagal";
  }
}


function nav($title)
{
  session_start();
 if (!isset($_SESSION["id_pegawai"])) {
     header("Location: ../../index.php?error=4");
 }
?>
  <!DOCTYPE html>
  <html>

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="../../style.css">-->

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/f26d8b4cf2.js" crossorigin="anonymous"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../plugins/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <title><?php echo $title ?></title>
  </head>

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="../../Logout.php">
          <span class="fa fa-sign-out-alt"></span>Logout
        </a>
      </li>
    </ul>
  </nav>

  <!-- <nav class="navbar navbar-expand sticky-top navbar-dark" style="background-color: #293949">
    <div class="container-fluid">
      <a class="navbar-brand">Toko Sembako Mutiara</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo ($title == "Data Barang" ? "active" : ""); ?>" href="tampilan-barang.php">Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($title == "Data Laporan" ? "active" : ""); ?>" href="tampilan-laporan-barang.php">Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($title == "Data Transaksi" ? "active" : ""); ?>" href="tampilan-transaksi.php">Transaksi</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->
<?php
}

function sidebar()
{
  ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img href=".png">
      <span class="brand-text font-weight-light">Toko Sembako Mutiara</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info" data-widget="treeview">
          <a class="d-block"> <span class="fa fa-user mr-3"></span>Halo, <?php echo $_SESSION["nama_pegawai"] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../barang/tampilan-barang.php" class="nav-link <?php echo ($judul == 'Data Barang' ? "active" : "") ?>">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../transaksi/tampilan-transaksi.php" class="nav-link <?php echo ($judul == "Transaksi" ? "active" : "") ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../laporan/tampilan-laporan-barang.php" class="nav-link <?php echo ($judul == "Laporan Barang Kosong" ? "active" : "") ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- AdminLTE App -->
<script src="../../plugins/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../plugins/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../plugins/js/demo.js"></script>
  <?php
}
?>