<?php
  
  require '../koneksi.h';
  require 'fungsi.php';

  if($_SESSION['nik'] == ""){
    header('location: login.php');
  }
  else{
    if(isset($_GET['idPengaduan'])){
      $varIdPengaduan = $_GET['idPengaduan'];
      $varNikPengguna = $_SESSION['nik'];

      $sql = "SELECT * FROM pengaduan WHERE (id_pengaduan='$varIdPengaduan' AND nik='$varNikPengguna');";
      $result = mysqli_query($conn, $sql);
      $data = mysqli_fetch_assoc($result); // data dari tabel pengaduan

      if($data == NULL){
        echo notifikasi('Data Laporan Tidak Ditemukan', 'riwayatPengaduan.php');
      }
      elseif($data != NULL){
        $varNik = $data['nik'];
        $sql2 = "SELECT * FROM masyarakat WHERE nik='$varNik';";
        $result2 = mysqli_query($conn, $sql2);
        $data2 = mysqli_fetch_assoc($result2); // data dari tabel masyarakat

        $sql3 = "SELECT * FROM tanggapan WHERE id_pengaduan='$varIdPengaduan' ;";
        $result3 = mysqli_query($conn, $sql3);

        if(mysqli_num_rows($result3) == 0){
          echo notifikasi('Tanggapan Belum Tersedia', 'riwayatPengaduan.php');
        }

        $data3 = mysqli_fetch_assoc($result3); // data dari tabel tanggapan

        $idPetugas = $data3['id_petugas'];
        $sql4 = "SELECT * FROM petugas WHERE id_petugas='$idPetugas';";
        $result4 = mysqli_query($conn, $sql4);
        $data4 = mysqli_fetch_assoc($result4); // data dari tabel petugas
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PROSES PENGADUAN MASYARAKAT</title>
</head>
<body>

  <div class="sidebar">
    <a href="dashboard.php">DASHBOARD</a>
    <a href="formPengaduan.php">FORM PENGADUAN</a>
    <a href="riwayatPengaduan.php">RIWAYAT PENGADUAN</a>
    <a href="logout.php">LOGOUT</a>
  </div>

  <div class="content">
    <h2 style="text-align: center;">LIHAT TANGGAPAN PENGADUAN MASYARAKAT</h2>

    <div class="container">
      <h4>Nama Pelapor: <?php echo $data2['nama'] ?></h4>
      <p><?php echo $data['isi_laporan'] ?></p>
      <img src="../media/laporan/ echo $data['foto'] ?>" width="300px">
      <h4>Tanggapan Petugas</h4>
      <p><?php echo $data3['tanggapan'] ?></p>
      <h4>Oleh</h4>
      <p><?php echo $data4['nama_petugas'] ?></p>
    </div>
  </div>

</body>
</html>