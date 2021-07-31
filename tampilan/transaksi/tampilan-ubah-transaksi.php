<?php
require('../../functions.php');

$id = $_GET["id_transaksi"];

$data = getDataTransaksiUpdate($id)->fetch_assoc();

nav("Ubah Transaksi");
?>

<body>
    <div class="container-fluid mt-4" align="center">
        <h1>Ubah Transaksi</h1>
        <form action="ubah-transaksi.php" method="POST" class="mt-5">
            <table class="table-sm">
                <tr>
                    <td width="25%">Id Transaksi</td>
                    <td width="50%"><input type="text" name="idTransaksi" class="form-control" required value="<?= $data['id_transaksi'];; ?>"readonly></td>
                </tr>
                <tr>
                    <td width="25%">Nama Barang</td>
                    <td width="50%"><select name="id" id="id" onchange="cek_db()" class="form-control" required>
					<option value="">--Pilih Nama Barang--</option>
					<?php
					$datakategori=getbarang();
					foreach($datakategori as $dataBarang){
					echo '<option name="id" value="'.$dataBarang["kode_barang"].'"';
					if($dataBarang["kode_barang"]==$data ["kode_barang"])
					echo " selected";
					echo '>'.$dataBarang['nama_barang'].'</option>';
					}
					?>
					</select>
					
					</td>
                </tr>
                <tr>
                    <td width="25%">Harga Barang</td>
                    <td width="50%"><input type="text" name="harga" id="harga" class="form-control" value="<?= $data['harga'];?>" required readonly></td>
                </tr>
                <tr>
                    <td width="25%">Stok</td>
                    <td width="50%"><input type="text" name="stok" id="stok" class="form-control" value="<?= $data['stok'];?>" required readonly></td>
                </tr>
				<tr>
                    <td width="25%">Jumlah</td>
                    <td width="50%"><input type="number" name="jumlah" class="form-control" required value="<?= $data['jml_beli']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right">
                        <a href="tampilan-transaksi.php" class="btn btn-secondary">Batal</a>
                        <input type="submit" name="tblSimpan" value="Simpan" class="btn btn-success">
                    </td>
                </tr>
            </table>
        </form>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>
      function cek_db(){
        var id = $("#id").val();
        $.ajax({
          url : 'autofill_proses.php',
          data : "id="+id,
        }).success(function (data){
          var json = data,
          obj = JSON.parse(json);
          $('#harga').val(obj.harga);
          $('#stok').val(obj.stok);
 
        })
      }
      </script>
</body>