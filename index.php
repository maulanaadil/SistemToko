<?php
require('functions.php');

//dbConnect();
?>
<!DOCTYPE html>
  <html>

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">

    <title>Login</title>
  </head>
<body>
	
<?php
if (isset($_GET["error"])) {
$error = $_GET["error"];
if ($error == 1)
showError("ID Pegawai dan password tidak sesuai.");
else if ($error == 2)
showError("Error database. Silahkan hubungi administrator");
else if ($error == 3)
showError("Koneksi ke Database gagal. Autentikasi gagal.");
else if ($error == 4)
showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login.
Silahkan login terlebih dahulu.");
else
showError("Unknown Error.");
}
?>
 
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="mb-5 mt-3 text-center text-primary">LOGIN</h3>
                
                <form action="login.php" method="post">
    
                <div class="mb-3">
                    <input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai">
                </div>
    
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
    
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" type="button">LOGIN</button>
                </div> 
    
                </form>
    
            </div>
            </div>
        </div>
        </div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
</html>
