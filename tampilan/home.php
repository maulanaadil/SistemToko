<?php
require('../functions.php');

dbConnect();

nav2("Home");

sidebar2();
$totalBarang = getTotalBarang()->fetch_array();
$totalTransaksi = getTotalTransaksi()->fetch_array();
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <p class="h3">Home</p>

                    </div><!-- /.col -->


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.container-fluid -->
            </div>
        </div> <!-- /. content-header -->
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $totalBarang[0]; ?></h3>

                                <p>Total Barang</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="barang/tampilan-barang.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $totalTransaksi[0]; ?></h3>

                                <p>Total Transaksi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="transaksi/tampilan-transaksi.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    </div>
    <!-- ./wrapper -->
    </body>




