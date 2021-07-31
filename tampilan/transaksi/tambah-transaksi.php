<?php
require('../../functions.php');


$db = dbConnect();

    $id_pegawai = "P001";
    $transaksi = $_POST['kode_barang'];
    $jumlah = $_POST['jumlah'];
    $jumlahTransaksi = $_POST['jumlah_transaksi'];
	$total = $_POST['total_harga'];
    $tanggalTransaksi=date('Y-m-d');


	$queryTransaksi = tambahTransaksi($id_pegawai, $tanggalTransaksi, $jumlahTransaksi, $total);

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

                $queryTransaksi = tambahDetailTransaksi($idTransaksi, $kodeBarang, $jml);
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


