<?php
session_start();
require('../../functions.php');

dbConnect();

nav("Transaksi");
?>

<body>
    <div class="container-fluid mt-4" align="center">
        <h1>Transaksi</h1>
        <form action="tambah-transaksi.php" method="POST" class="mt-5" enctype="multipart/form-data">
            <table class="table-sm">
                <tr>
                    <td width="25%">Nama Barang</td>
                    <td width="50%"><select name="id" id="id" onchange="cek_db()" class="form-control" required>
					<option value="">--Pilih Nama Barang--</option>
					<?php
					$datakategori=getbarang();
					foreach($datakategori as $data){
					echo '<option name="id" value="'.$data["kode_barang"].'">'.$data['nama_barang'].'</option>';
					}
					?>
					</select>
					</td>
                </tr>
                <tr>
                    <td width="25%">Harga</td>
                    <td width="50%"><input type="text" name="harga" id="harga" class="form-control" required readonly></td>
                </tr>
                <tr>
                    <td width="25%">Stok</td>
                    <td width="50%"><input type="text" name="stok" id="stok" class="form-control" required readonly></td>
                </tr>
				<tr>
                    <td width="25%">Jumlah</td>
                    <td width="50%"><input type="number" name="jumlah" class="form-control" required></td>
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