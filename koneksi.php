<?php
$koneksi = mysqli_connect("localhost","root","","pengaduan_native");
?>

MASYARAKAT

<!-- REGISTRASI -->
<?php
session_start();
require '../koneksi.php';
if(isset($_POST['nama']) && ($_POST['password'])) {
    $nik=$_POST['nik'];
    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $telp=$_POST['telp'];
    $password=md5($_POST['password']);

    $query = mysqli_query($koneksi,"INSERT INTO masyarakat VALUES('$nik','$nama','$username','$password','$telp')");
    if($query){
        header('location:login.php');
    } else {
        echo "MAAF ANDA GAGAL MELAKUKAN REGISTRASI!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <div class="header">
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top" style="height:70px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">PENGADUAN</a>
                </li>
                <li class="nav-item">
                    <a href="cek-pengaduan.php" class="nav-link">CEK PENGADUAN</a>
                </li>
            </ul>
        </nav>

    <div class="inner-header" style="padding-top:100px;">
        <div class="row justify-content-center">
            <div class="card shadow-lg mb-5">
                <div class="container-fluid">

                <form action="registrasi.php" method="POST">
                    <div class="card-body mt-2">
                        <h4 class="text-center">REGISTRASI</h4>
                        <hr style="width:70%;">
                        <div class="form-group">
                            <label for="nik" style="float:left;">NIK :</label>
                            <input type="nik" name="nik" id="nik" class="form-control mb-4">
                            <label for="nama" style="float:left;">NAMA :</label>
                            <input type="text" name="nama" id="nama" class="form-control mb-4">
                            <label for="username" style="float:left;">USERNAME :</label>
                            <input type="text" name="username" id="username" class="form-control mb-4">
                            <label for="telp" style="float:left;">TELEPON :</label>
                            <input type="text" name="telp" id="telp" class="form-control mb-4">
                            <label for="password">PASSWORD :</label>
                            <input type="password" name="password" id="password" class="form-control mb-4">
                            <hr>
                            <p>Already Have Account? <a href="login.php" style="color:black;">Login</a></p>
                            <button class="btn btn-succes" type="submit" name="button">Daftar</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

    </div>
</body>
</html>

<!-- LOGIN & PROSES-LOGIN -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pengaduan Masyarakat</title>
</head>
<body>
    
    <div class="header">
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top" style="height:70px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">PENGADUAN</a>
                </li>
                <li class="nav-item">
                    <a href="cek-pengaduan.php" class="nav-link">CEK PENGADUAN</a>
                </li>
            </ul>
        </nav>

    <div class="inner-header" style="padding-top:250px;">
        <div class="row justify-content-center">
            <div class="card shadow-lg mb-5">
                <div class="container-fluid">

                <form action="proses-login.php" method="POST">
                    <div class="card-body mt-2">
                        <h4 class="text-center"><a href="../admin/login.php" style="color:black;">LOGIN</a></h4>
                        <hr style="width:70%;">
                        <div class="form-group">
                            <label for="nik" style="float:left;">NIK :</label>
                            <input type="nik" name="nik" id="nik" class="form-control mb-4">
                            <label for="password">PASSWORD :</label>
                            <input type="password" name="password" id="password" class="form-control mb-4">
                            <hr>
                            <p>Doesn't Have Account? <a href="registrasi.php" style="color:black;">Daftar</a></p>
                            <button class="btn btn-succes" type="submit" name="button">Kirim</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

    </div>

</body>
</html>

<?php
session_start();
include '../koneksi.php';
$nik=$_POST['nik'];
$password=md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nik' AND password='$password' ");

$cek = mysqli_num_rows($query);
if($cek > 0) {
    $_SESSION['nik'] = $nik;
    $_SESSION['status'] = "login";
    foreach ($query as $key => $query){
        $_SESSION['nik'] = $query['nik'];
    } 
    header('location:pengaduan.php');
} else {
    echo "<script>alert('NIK atau Password yang Anda Masukkan Salah!!!')</script>";
    echo "<script>document.location='login.php'</script>";
}

?>

<!-- HOME -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pengaduan Masyarakat</title>
</head>
<body>
    
    <div class="header">
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top" style="height:70px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">PENGADUAN</a>
                </li>
                <li class="nav-item">
                    <a href="cek-pengaduan.php" class="nav-link">CEK PENGADUAN</a>
                </li>
            </ul>
        </nav>

        <div class="inner-header" style="padding-top:250px;">
            <div class="row justify-content-center">
                <div class="card shadow-lg mb-5">
                    <div class="card-body">

                    <h1>Layanan Aspirasi & Pengaduan Rakyat</h1>
                    <h3>Sampaikan Laporan Kepada Kami!!!</h3>

                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>

<!-- PENGADUAN & PROSES-PENGADUAN -->

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pengaduan Masyarakat</title>
</head>
<body>
    
    <div class="header">
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top" style="height:70px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">PENGADUAN</a>
                </li>
                <li class="nav-item">
                    <a href="cek-pengaduan.php" class="nav-link">CEK PENGADUAN</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
            <a href="proses-logout.php"><button class="btn btn-danger" name="button" type="submit">Log Out</button></a>
        </nav> 

    <div class="inner-header" style="padding-top:250px;">
        <div class="row justify-content-center">
            <div class="card shadow-lg mb-5">
                <div class="container-fluid">

                <div class="card-body">
                    <form action="proses-pengaduan.php" method="POST" enctype="multipart/form-data">
                        <h5>NIK : <?= $_SESSION['nik'] ?></h5>
                        <div class="form-group">
                            <label for="isi_laporan">Laporan :</label>
                            <textarea name="isi_laporan" id="isi_laporan" rows="3" class="form-control textarea" placeholder="Silahkan Masukkan Laporan Anda...."></textarea>
                            <label for="foto">Foto :</label><br>
                            <input type="file" name="foto" id="foto" required>
                            <hr>
                            <button class="btn btn-succes" name="button" type="submit">Kirim</button>
                        </div> 
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>

    </div>

</body>
</html>

<?php
session_start();
include '../koneksi.php';

if(isset($_POST['button'])) {
    $tgl=date("Y-m-d H:i:s");
    $nik=$_SESSION['nik'];
    $laporan=$_POST['isi_laporan'];
    $ekstensi=array('png','jpg');
    $nama=$_FILES['foto']['name'];
    $x=explode('.', $nama);
    $eks=strtolower(end($x));
    $ukuran=$_FILES['foto']['size'];
    $file_tmp=$_FILES['foto']['tmp_name'];

    if(in_array($eks, $ekstensi) == true ){
        if($ukuran < 10440700){
            move_uploaded_file($file_tmp, 'foto/'.$nama);
            $query=mysqli_query($koneksi, "INSERT INTO pengaduan VALUES(NULL,'$tgl','$nik','$laporan','$nama','0')");
            if($query){
                header('location:pengaduan.php?pengaduan=sukses');
            } else {
                header('location:pengaduan.php?pengaduan=gagal');
            }
        } else {
            die ("AKSES DILARANG!");
        }
    }
}
?>

<!-- CEK PENGADUAN -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Pengaduan Masyarakat</title>
</head>
<body>
    
    <div class="header">
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top" style="height:70px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">PENGADUAN</a>
                </li>
                <li class="nav-item">
                    <a href="cek-pengaduan.php" class="nav-link">CEK PENGADUAN</a>
                </li>
            </ul>
        </nav>

    <div class="inner-header" style="padding-top:250px;">
        <div class="row justify-content-center">
            <div class="card shadow-lg mb-5">
                <div class="card-body">

                <?php
                if(isset($_GET['nik'])){
                    include '../koneksi.php';
                    $nomor=1;
                    $nik=$_GET['nik'];
                    $query=mysqli_query($koneksi, "SELECT pengaduan.tgl_pengaduan, pengaduan.isi_laporan, pengaduan.status, tanggapan.tanggapan
                    FROM tanggapan LEFT JOIN pengaduan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan WHERE pengaduan.nik=$nik");
                    $cek = mysqli_num_rows($query);
                ?>
                <?php if($cek || $cek > 0) { ?>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No .</th>
                                <th>Tanggal</th>
                                <th>Laporan</th>
                                <th>Status</th>
                                <th>Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data = mysqli_fetch_array($query)){
                                echo "<tr>";
                                echo "<td>".$nomor."</td>";
                                echo "<td>".$data['tgl_pengaduan']."</td>";
                                echo "<td>".$data['isi_laporan']."</td>";
                                echo "<td>".$data['status']."</td>";
                                echo "<td>".$data['tanggapan']."</td>";
                                echo "</tr>";
                                $nomor++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php } else { ?>
                        <p>Pengaduan Belum Ditanggapi!!!</p>
                        <?php } ?>
                        <a href="cek-pengaduan.php" class="btn btn-succes">Kembali</a>
                        <?php } else { ?>
                            <form action="" method="GET">
                                <div class="form-group">
                                    <label for="" style="float:left;">NIK :</label>
                                    <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK Anda!" required><br>
                                    <button class="btn btn-succes" type="submit">Cek</button>
                                </div>
                                
                            </form>
                            <?php } ?>

                </div>
            </div>
        </div>
    </div>

    </div>

</body>
</html>

<!-- ADMIN -->

<!-- LOGIN & PROSES -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Admin</title>
    <style>
        .container{
            margin-top:9%;
            width:30%;
        }
    </style>
</head>
<body>

    <div class="container">
        <h4 class="text-center"><a href="../masyarakat/login.php" style="color:black;">LOGIN</a></h4>
        <hr style="width:70%;">
        <form action="proses-login.php" method="POST">
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username!!">
            </div>
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password!!">
            </div>
            <button class="btn btn-primary" type="submit">LOGIN</button>
            <button class="btn btn-danger" type="reset">RESET</button>
        </form>
    </div>

</body>
</html>

<?php
session_start();
include '../koneksi.php';
$username=$_POST['username'];
$password=md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
$cek = mysqli_num_rows($query);
$w = mysqli_fetch_array($query);
if($cek > 0) {
    $_SESSION['username'] = $w['username'];
    $_SESSION['password'] = $w['password'];
    $_SESSION['level'] = $w['level'];

    $_SESSION['login'] = "Y";
    header ('location:dashboard.php');
} else {
    echo "<script>alert('Username atau Password yang Anda Masukkan Salah!!!')</script>";
    echo "<script>document.location='login.php'</script>";
}
?>

<!-- DASHBOARD -->

<?php
session_start();
include '../koneksi.php';
if($_SESSION['login'] != 'Y'){
    header('location:login.php?module=home');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-3">
        <h2 style="margin-left:22%; color:white;">Layanan Aspirasi & Pengaduan Masyarakat</h2>
    </nav>

    <div class="row" id="body-row">

        <div class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="dashboard.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Dashboard</span>
                </div>
                </a>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                <a href="masyarakat.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Masyarakat</span>
                </div>
                </a>
                <a href="petugas.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Petugas</span>
                </div>
                </a>
                <?php
                }
                ?>
                <a href="pengaduan.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Pengaduan</span>
                </div>
                </a>
                <a href="login.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Logout</span>
                </div>
                </a>
            </ul>
        </div>

        <div class="col p-4">
            <h4 class="display-5 mb-4">DASHBOARD</h4>
            <hr class="height: 10px;">
            
            <div class="row text-black">
                <?php
                if($_SESSION['level'] == 'admin') {
                ?>
                <div class="shadow-lg p-3 mb-4 ml-4 bg-body rounded" style="width: 18rem;">
                <div class="card-body overview-item-c1">
                    <h5 class="card-title">MASYARAKAT</h5>
                    <div class="display-4">
                        <?php
                        $sql="SELECT * FROM masyarakat";
                        $query=mysqli_query($koneksi, $sql);
                        echo mysqli_num_rows($query);   
                        ?>
                    </div>
                    <a href="masyarakat.php"><p class="card-text text-black">Lihat Detail</p></a>
                </div>
                </div>
                <div class="shadow-lg p-3 mb-4 ml-4 bg-body rounded" style="width: 18rem;">
                <div class="card-body overview-item-c1">
                    <h5 class="card-title">PETUGAS</h5>
                    <div class="display-4">
                       <?php
                        $sql="SELECT * FROM petugas";
                        $query=mysqli_query($koneksi, $sql);
                        echo mysqli_num_rows($query);
                       ?>
                    </div>
                    <a href="petugas.php"><p class="card-text text-black">Lihat Detail</p></a>
                </div>
                </div>
                <?php } ?>
                <div class="shadow-lg p-3 mb-4 ml-4 bg-body rounded" style="width: 18rem;">
                <div class="card-body overview-item-c1">
                    <h5 class="card-title">PENGADUAN</h5>
                    <div class="display-4">
                        <?php
                        $sql="SELECT * FROM pengaduan";
                        $query=mysqli_query($koneksi, $sql);
                        echo mysqli_num_rows($query);
                        ?>
                    </div>
                    <a href="pengaduan.php"><p class="card-text text-black">Lihat Detail</p></a>
                </div>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>

<!-- MASYARAKAT -->

<?php
session_start();
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-3">
        <h2 style="margin-left:22%; color:white;">Layanan Aspirasi & Pengaduan Masyarakat</h2>
    </nav>

    <div class="row" id="body-row">

        <div class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="dashboard.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Dashboard</span>
                </div>
                </a>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                <a href="masyarakat.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Masyarakat</span>
                </div>
                </a>
                <a href="petugas.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Petugas</span>
                </div>
                </a>
                <?php
                }
                ?>
                <a href="pengaduan.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Pengaduan</span>
                </div>
                </a>
                <a href="login.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Logout</span>
                </div>
                </a>
            </ul>
        </div>

        <div class="col p-4">
            <h4 class="display-5 mb-4">MASYARAKAT</h4>
            <hr class="height: 10px;">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg mb-5">
                        <div class="card-body">

                            <table class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>No. Telepon</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="SELECT * FROM masyarakat";
                                $query=mysqli_query($koneksi, $sql);
                                $nomor=1;
                                while($data = mysqli_fetch_array($query)){
                                    echo "<tr>";
                                    echo "<td>".$nomor."</td>";
                                    echo "<td>".$data['nik']."</td>";
                                    echo "<td>".$data['nama']."</td>";
                                    echo "<td>".$data['username']."</td>";
                                    echo "<td>".$data['telp']."</td>";
                                    echo "<td>";
                                    echo "<a href='hapus-masyarakat.php?nik=".$data['nik']."'><button class='btn btn-danger'>Hapus</button></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $nomor++;
                                }
                                ?>
                            </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
</body>
</html>

<!-- PETUGAS -->

<?php
session_start();
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-3">
        <h2 style="margin-left:22%; color:white;">Layanan Aspirasi & Pengaduan Masyarakat</h2>
    </nav>

    <div class="row" id="body-row">

        <div class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="dashboard.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Dashboard</span>
                </div>
                </a>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                <a href="masyarakat.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Masyarakat</span>
                </div>
                </a>
                <a href="petugas.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Petugas</span>
                </div>
                </a>
                <?php
                }
                ?>
                <a href="pengaduan.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Pengaduan</span>
                </div>
                </a>
                <a href="login.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Logout</span>
                </div>
                </a>
            </ul>
        </div>

        <div class="col p-4">
            <h4 class="display-5 mb-4">PETUGAS</h4>
            <hr class="height: 10px;">
            <a href="tambah-petugas.php"><button class="btn btn-primary mb-3" name="button" type="submit">TAMBAH</button></a>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg mb-5">
                        <div class="card-body">

                            <table class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>No. Telepon</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="SELECT * FROM petugas";
                                $query=mysqli_query($koneksi, $sql);
                                $nomor=1;
                                while($data = mysqli_fetch_array($query)){
                                    echo "<tr>";
                                    echo "<td>".$nomor."</td>";
                                    echo "<td>".$data['nama_petugas']."</td>";
                                    echo "<td>".$data['username']."</td>";
                                    echo "<td>".$data['level']."</td>";
                                    echo "<td>".$data['telp']."</td>";
                                    echo "<td>";
                                    echo "<a href='hapus-petugas.php?id_petugas=".$data['id_petugas']."'><button class='btn btn-danger'>Hapus</button></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $nomor++;
                                }
                                ?>
                            </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
</body>
</html>

<!-- PENGADUAN -->

<?php
session_start();
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-3">
        <h2 style="margin-left:22%; color:white;">Layanan Aspirasi & Pengaduan Masyarakat</h2>
    </nav>

    <div class="row" id="body-row">

        <div class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="dashboard.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Dashboard</span>
                </div>
                </a>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                <a href="masyarakat.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Masyarakat</span>
                </div>
                </a>
                <a href="petugas.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Petugas</span>
                </div>
                </a>
                <?php
                }
                ?>
                <a href="pengaduan.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Pengaduan</span>
                </div>
                </a>
                <a href="login.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Logout</span>
                </div>
                </a>
            </ul>
        </div>

        <div class="col p-4">
            <h4 class="display-5 mb-4">PENGADUAN</h4>
            <hr class="height: 10px;">
            
            <a href="cetak.php"><button class="btn btn-primary mb-3" name="button" type="submit">PDF</button></a>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg mb-5">
                        <div class="card-body">

                            <table class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Tanggal</th>
                                    <th>NIK</th>
                                    <th>Pengaduan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="SELECT * FROM pengaduan";
                                $query=mysqli_query($koneksi, $sql);
                                $nomor=1;
                                while($data = mysqli_fetch_array($query)){
                                    echo "<tr>";
                                    echo "<td>".$nomor."</td>";
                                    echo "<td>".$data['tgl_pengaduan']."</td>";
                                    echo "<td>".$data['nik']."</td>";
                                    echo "<td>".$data['isi_laporan']."</td>";
                                    echo "<td>"."<img style='width:350px;' src='../masyarakat/foto/".$data['foto']."'>"."</td>";
                                    echo "<td>".$data['status']."</td>";
                                    echo "<td>";
                                    echo "<a href='ubah-status.php?id_pengaduan=".$data['id_pengaduan']."'><button class='btn btn-info mr-1'>Ubah Status</button></a>";
                                    echo "<a href='tanggapan.php?id_pengaduan=".$data['id_pengaduan']."'><button class='btn btn-warning mr-1'>Tanggapi</button></a>";
                                    echo "<a href='hapus-pengaduan.php?id_pengaduan=".$data['id_pengaduan']."'><button class='btn btn-danger mr-1'>Hapus</button></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $nomor++;
                                }
                                ?>
                            </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
</body>
</html>

<!-- UBAH STATUS -->

<?php
session_start();
require '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-3">
        <h2 style="margin-left:22%; color:white;">Layanan Aspirasi & Pengaduan Masyarakat</h2>
    </nav>

    <div class="row" id="body-row">

        <div class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="dashboard.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Dashboard</span>
                </div>
                </a>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                <a href="masyarakat.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Masyarakat</span>
                </div>
                </a>
                <a href="petugas.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Petugas</span>
                </div>
                </a>
                <?php
                }
                ?>
                <a href="pengaduan.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Pengaduan</span>
                </div>
                </a>
                <a href="login.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Logout</span>
                </div>
                </a>
            </ul>
        </div>

        <div class="col p-4">
            <h4 class="display-5 mb-4">UBAH STATUS</h4>
            <hr class="height: 10px;">
            
                <div class="col-md-12">
                    <div class="card shadow-lg mb-5">
                        <div class="card-body">

                        <?php
                        if(isset($_GET['id_pengaduan'])){
                            $nomor=1;
                            $id_pengaduan=$_GET['id_pengaduan'];
                            $query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan=$id_pengaduan");
                            $petugas=$_SESSION["username"];
                            $data = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$petugas'");
                            $w = mysqli_fetch_array($data);
                        ?>

                        <?php
                        while($konten = mysqli_fetch_array($query)){
                        ?>

                            <form action="proses-ubah-status.php" method="POST">
                                <input type="hidden" name="id_pengaduan" value="<?= $konten['id_pengaduan']; ?>">
                                <input type="hidden" name="id_petugas" value="<?= $w['id_petugas']; ?>">
                                <div class="form-group">
                                <label for="">Tanggal Pengaduan</label>
                                <input readonly type="text" class="form-control bg-white" name="tgl_pengaduan" value="<?= $konten['tgl_pengaduan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input readonly type="text" class="form-control bg-white" name="nik" value="<?= $konten['nik'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Isi Pengaduan</label>
                                <input readonly type="text" class="form-control bg-white" name="isi_laporan" value="<?= $konten['isi_laporan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <?php if ($konten['status'] == 0 ) {?>
                                        <option selected value="0">Belum Dibaca</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    <?php } else if ($konten['status'] == "proses") { ?>
                                        <option value="0">Belum Dibaca</option>
                                        <option selected value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    <?php  } else { ?>
                                        <option value="0">Belum Dibaca</option>
                                        <option value="proses">Proses</option>
                                        <option selected value="selesai">Selesai</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button class="btn btn-info mt-5 float-right" type="submit" name="submit">Ubah</button>
                        </form>
                        <?php  }} ?>

                        </div>
                    </div>
                </div>

        </div>

    </div>
    
</body>
</html>

<?php
include '../koneksi.php';
if(isset($_POST['submit'])){
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_pengaduan = $_POST['tgl_pengaduan'];
    $nik = $_POST['nik'];
    $laporan = $_POST['isi_laporan'];
    $status = $_POST['status'];

    $query = mysqli_query($koneksi, "UPDATE pengaduan SET tgl_pengaduan='$tgl_pengaduan', nik='$nik', isi_laporan='$laporan', status='$status' WHERE id_pengaduan='$id_pengaduan' ");
    
    if($query){
        header('location:pengaduan.php');
    } else {
        die ("GAGAL MENYIMPAN PERUBAHAN");
    }
} else {
    die("AKSES DILARANG!");
}
?>

<!-- TANGGAPAN & PROSES -->

<?php
session_start();
require '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Pengaduan Masyarakat</title>
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-3">
        <h2 style="margin-left:22%; color:white;">Layanan Aspirasi & Pengaduan Masyarakat</h2>
    </nav>

    <div class="row" id="body-row">

        <div class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <a href="dashboard.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Dashboard</span>
                </div>
                </a>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
                </li>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                <a href="masyarakat.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Masyarakat</span>
                </div>
                </a>
                <a href="petugas.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Petugas</span>
                </div>
                </a>
                <?php
                }
                ?>
                <a href="pengaduan.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Pengaduan</span>
                </div>
                </a>
                <a href="login.php" class="bg-white list-group-item list-group-item-action">
                <div class="align-items-center">
                    <span class="menu-collapsed">Logout</span>
                </div>
                </a>
            </ul>
        </div>

        <?php
        $petugas=$_SESSION["username"];
        $query=mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$petugas'");

        $w=mysqli_fetch_array($query);
        ?>

        <div class="col p-4">
            <h4 class="display-5 mb-4">TANGGAPAN</h4>
            <hr class="height: 10px;">
            
                <div class="col-md-12">
                    <div class="card shadow-lg mb-5">
                        <div class="card-body">

                            <form action="proses-tanggapan.php" method="POST">
                                <input type="hidden" name="id_pengaduan" value="<?= $_GET['id_pengaduan'] ?>">
                                <input type="hidden" name="id_petugas" value="<?= $w['id_petugas'] ?>">
                                <h5>Nama Petugas : <?= $w['nama_petugas'] ?></h5>
                                <div class="form-group">
                                    <label for="" style="float:left;">Tanggapan :</label>
                                    <textarea class="form-control textarea mb-4" name="tanggapan" cols="30" rows="3" placeholder="Masukkan Tanggapan Anda!"></textarea>
                                    <button class="btn btn-succes" name="submit" type="submit">Kirim</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

        </div>

    </div>
    
</body>
</html>

<?php

include '../koneksi.php';

if(isset($_POST['submit'])) {
    $id_pengaduan=$_POST['id_pengaduan'];
    $tgl_tanggapan=date('Y-m-d H:i:s');
    $tanggapan=$_POST['tanggapan'];
    $id_petugas=$_POST['id_petugas'];

    $query = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES(NULL, '$id_pengaduan','$tgl_tanggapan','$tanggapan','$id_petugas')");

    if($query){
        header('location:pengaduan.php?tanggapan=sukses');
    } else {
        header('location:pengaduan.php?tanggapan=gagal');
    }
} else {
    die("AKSES DILARANG!!!");
}

?>

<!-- CETAK -->

<h2 style="text-align: center;">LAPORAN LAYANAN PENGADUAN MASYARAKAT</h2>
<table border="2" style="width:100%; height:10%;">

<tr style="text-align: center;">
    <td>No.</td>
    <td>NIK Pelapor</td>
    <td>Nama Pelapor</td>
    <td>Nama Petugas</td>
    <td>Tanggal Masuk</td>
    <td>Tanggal Ditanggapi</td>
    <td>Status</td>
</tr>
    <?php
    include '../koneksi.php';
    $no=1;
    $query=mysqli_query($koneksi, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON
    tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tgl_pengaduan DESC");
    while ($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $no++;?></td>
        <td><?= $data['nik']; ?></td>
        <td><?= $data['nama']; ?></td>
        <td><?= $data['nama_petugas']; ?></td>
        <td><?= $data['tgl_pengaduan']; ?></td>
        <td><?= $data['tgl_tanggapan']; ?></td>
        <td><?= $data['status']; ?></td>
    </tr>
    <?php } ?>

</table>

<script type="text/javascript">
    window.print();
</script>