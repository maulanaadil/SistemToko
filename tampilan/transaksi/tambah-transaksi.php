<?php
session_start();
require('../../functions.php');

nav("Tambah Transaksi");
$db = dbConnect();
if(isset($_POST['tblSimpan'])) {
    $transaksi = ($_POST['kode_barang']);
    $harga = $db->escape_string($_POST['harga']);
    $jumlah = ($_POST['jumlah']);
    $jumlahTransaksi = $db->escape_string($_POST['jumlah_transaksi']);
	$total = $db->escape_string($_POST['total_harga']);
	$tanggalTransaksi=date('Y-m-d');
	
	$queryTransaksi = tambahTransaksi($id_pegawai, $tanggalTransaksi, $jumlahTransaksi, $total);

    // $sql = tambahDetailTransaksi($kodeBarang,$jumlahBarang,$total);
    // $res = $db->query($sql);
	
	if(mysqli_query($db, $queryTransaksi)){
        if($db->affected_rows > 0) {
            $query = "SELECT id_transaksi FROM transaksi ORDER BY tgl_transaksi DESC";
            $data = mysqli_query($db, $query);
            $row = mysqli_fetch_array($data);
            $trs = $row['id_transaksi'];

            $count = count($transaksi);

            for($i = 0; $i < $count; $i++){
                $data = array ('id_transaksi' => $trs,
                'kode_barang' => $transaksi[$i],
                'jml_beli' => $jumlah[$i],
            );

                $idTransaksi = $data['id_transaksi'];
                $kodeBarang = $data['kode_barang'];
                $jml = $data['jml_beli'];

                $queryTransaksi = tambahDetailTransaksi($idTransaksi, $kodeBarang, $jmlBeli);
                $queryUpdateStokBarang = updateStokBarang($kodeBarang, $jml);
                mysqli_query($db, $queryTransaksi);
                mysqli_query($db, $queryUpdateStokBarang);
            }
            if($db->affected_rows>0){
                echo 1;
            }else{
                echo 0;
            }

        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
}else {
    echo 0;
}
