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

//function insert detail transaksi ke database
function tambahDetailTransaksi($kodeBarang, $jumlahBarang, $total)
{
  return "INSERT INTO detail_transaksi (kode_barang, jml_beli, total) VALUES ('$kodeBarang', '$jumlahBarang', '$total')";
}

//function insert data transaksi ke database
function tambahTransaksi($id_pegawai, $tanggalTransaksi)
{
  return "INSERT INTO transaksi (id_pegawai, tgl_transaksi) VALUES ('$id_pegawai', '$tanggalTransaksi')";
}

//function untuk ambil data data transaksi
function getDataTransaksi()
{
  $db = dbConnect();
  $sql = "SELECT * FROM pegawai NATURAL JOIN transaksi NATURAL JOIN detail_transaksi
				 NATURAL JOIN barang";
  return $db->query($sql);
}


function nav($title)
{
?>
  <!DOCTYPE html>
  <html>

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">

    <title><?php echo $title ?></title>
  </head>

  <nav class="navbar navbar-expand sticky-top navbar-dark" style="background-color: #293949">
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
  </nav>
<?php
}
?>
