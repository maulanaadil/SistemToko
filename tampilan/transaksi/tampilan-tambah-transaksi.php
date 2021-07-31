<?php
require('../../functions.php');


nav("Transaksi"); 

sidebar();
?>

<body>
    <div class="content-wrapper">
    <div class="content-header"></div>
    <h1 align="center">Tambah Transaksi</h1>
    <div class="row">
    <div class="col-sm-6 offset-sm-3">
    <form role="form" id="frm-data">
        <table align="center" class="table-sm table table-condensed">
            <tr>
                <td>Pilih Menu</td>

                <td>
                <select name="slc_menu" id="slc-menu" class="form-control">
                    <option value="">- Pilih Menu -</option>
                    <?php
                    dbConnect();
                    $data = getBarang()->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $row) { ?>
                    <option value="<?= $row['kode_barang']; ?>,<?= $row['stok']; ?>"
                            data-harga="<?= $row['harga']; ?>"><?= $row['nama_barang']; ?></option>
                    <?php } ?>
                </select>
                Stok <span class="text_stok"></span>
                    <input name="stok-hide" id="stok-hide" value="<?= $row['stok'];  ?>" hidden readonly>

                </td>
                <td>
                    <input type="text" name="txt_jumlah" class="form-control" placeholder="jumlah">
                </td>
                <td>
                    <i class="btn btn-xs btn-success" id="add-menu"><i class="icon icon-plus"></i></i>
                </td>
            <tr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Nama Menu</td>
                        <td>Jumlah</td>
                        <td>Sub Total</td>
                    </tr>
                    </thead>
                    <tbody id="result_menu">

                    </tbody>
                    </table>
                </tr>
                <tr>
                    <td>Jumlah Transaksi</td>
                    <td><input type="number" id="jumlah_transaksi" name="jumlah_transaksi" class="form-control" placeholder="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td><input type="number" id="total_harga" name="total_harga" class="form-control" placeholder="0" readonly></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
            </form>

            <div class="button" align="right">
                <button value="Submit" class="btn btn-success" name="btnSubmit" id="btn-save"> Simpan </button>
            </div>
    </div>
    </div>
    </body>
    <script>
        $(document).ready(function () {
            var stok;
            $("#btn-save").click(function(){
                doSave();
            })

            $('#slc-menu').on('change', function() {
                var expl = $(this).val().split(",");
                $(".text_stok").text(expl[1]);

                stok = expl[1];
            });
            window.arrayItem = [];
            var i = 0;
            window.arrayTransaksi=[];
            window.arrayTotal=[];
            var jumlah_transaksi=0;
            var jumlah_total=0;
            var jumlah_total2=0;
            var jumlah_transaksi2=0;

            $("#add-menu").click(function () {
                ++i;
                var id = $("select[name='slc_menu']").val().split(",");
                var menu = $("select[name='slc_menu']").find(':selected').text();

                var jumlah = $("input[name='txt_jumlah']").val();
                var harga = $("select[name='slc_menu']").find(':selected').data('harga');


                var check = true;
                $.each(arrayItem, function (key, value) {
                    if (menu == value) {
                        check = false;
                    }
                })
                if (check === false) {
                    swal.fire({
                        icon: "info",
                        title: "Failed",
                        text: "Menu sudah di inputkan!",
                        showConfirmButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Alright!",
                    });
                    return false;
                } else if (jumlah <= 0) {
                    swal.fire({
                        icon: "info",
                        title: "Failed",
                        text: "Jumlah Menu Kosong",
                        showConfirmButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Alright!",
                    });
                    $("input[name='txt_jumlah']").focus();
                    return false;
                } else if (stok <= jumlah) {
                    swal.fire({
                        icon: "error",
                        title: "Failed",
                        text: "Data Jumlah melebihi data stok!",
                        showConfirmButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Alright!",
                    });
                    $("input[name='txt_jumlah']").focus();
                    return false;
                }
                var append_id = "result_menu";

                $("#" + append_id).append('<tr id="item' + i + '"><td style="vertical-align:middle"><span>' + menu + '</span><input type="hidden" name="kode_barang[]" value="' + id[0] + '"></td><td class="text_transaksi" style="vertical-align:middle"<span>' + jumlah + '</span><input type="hidden" name="jumlah[]" value="' + jumlah + '"></td><td class="text_total" style="vertical-align:middle"<span>' + parseInt(harga)*parseInt(jumlah) + '</span></td><td align="center"><button type="button" class="btn btn-danger btn-xs" onclick="deleteItem(' + i + ',' + parseInt(harga)*parseInt(jumlah) +',' + jumlah +')"><i class="icon icon-trash"></i></button></td></tr>');
                arrayItem.push(menu);

                jumlah_transaksi=parseInt(arrayTransaksi[1])+parseInt(jumlah);
                jumlah_total=parseInt(arrayTotal[1])+(parseInt(jumlah)*parseInt(harga));



                $("button").addClass("");
                $("select[name='slc_menu']").val("");
                $("input[name='txt_jumlah']").val("");
                $(".text_stok").text("");
                jumlah_total2=0;
                jumlah_transaksi2=0;
                $('#result_menu tr').each(function() {
                    jumlah_transaksi2 += parseInt($(this).find(".text_transaksi").text());
                    jumlah_total2 += parseInt($(this).find(".text_total").text());
                });
                $("#jumlah_transaksi").val(jumlah_transaksi2);
                $("#total_harga").val(jumlah_total2);

                });
            });

            function deleteItem(id,total,jumlah) {
                var jumlah_transaksi= $("#jumlah_pemesanan").val()-parseInt(jumlah);
                var jumlah_total=$("#total_harga").val()-parseInt(total);

                $("#jumlah_pemesanan").val(jumlah_transaksi);
                $("#total_harga").val(jumlah_total);
                arrayItem.remove($("#item" + id + " td span").first().text());
                $("#item" + id).remove();
            }

            Array.prototype.remove = function (x) {
                var i;
                for (i in this) {
                    if (this[i].toString() == x.toString()) {
                        this.splice(i, 1)
                    }
                }
            }

            function doSave(){
                $.ajax({
                    type:"POST",
                    data:$("#frm-data").serialize(),

                    url : "tambah-transaksi.php",

                    beforeSend:function (){

                    },

                    success:function (reponse){
                        if(reponse==1){
                            swal.fire({
                                title: "Informasi!",
                                text: "berhasil",
                                icon: "info",
                                button: "OK!",
                            }).then((value) => {
                                location.reload();
                            });

                        }else{
                            swal.fire({
                                title: "Informasi!",
                                text: "error",
                                icon: "error",
                                button: "OK!",
                            }).then((value) => {
                                location.reload();
                            });
                        }

                    }

                })

        }
    </script>
</html>
