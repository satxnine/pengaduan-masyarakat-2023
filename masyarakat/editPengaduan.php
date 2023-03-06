<?php
  require '../koneksi.php';
  require 'fungsi.php';
  
  if($_SESSION['nik'] == ""){
    header('location: login.php');
  }
  else{
    if(isset($_GET['edit'])){
      $varIdPengaduan = $_GET['edit'];
      $varNik = $_SESSION['nik'];

      $query = "SELECT * FROM pengaduan WHERE (id_pengaduan='$varIdPengaduan' AND nik='$varNik');";
      $sql = mysqli_query($conn, $query);
      $result = mysqli_fetch_assoc($sql);

      if($result == NULL){
        echo notifikasi("Data Laporan Tidak Ditemukan!", "riwayatPengaduan.php");
      }
      elseif($result['status'] != '0'){
        echo notifikasi('Data Laporan Tidak Dapat Diedit', 'riwayatPengaduan.php');
      }
      else{
        $varLaporan = $result['isi_laporan'];
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EDIT DATA PENGADUAN MASYARAKAT</title>
</head>
<body>

<div class="sidebar">
  <a href="dashboard.php">DASHBOARD</a>
  <a href="formPengaduan.php">FORM PENGADUAN</a>
  <a href="riwayatPengaduan.php">RIWAYAT PENGADUAN</a>
  <a href="logout.php">LOGOUT</a>
</div>

<div class="content">
  <h2>EDIT DATA PENGADUAN</h2>

  <div class="container">

    <form action="prosesUser.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="idLaporanPengaduan" value="<?php echo $varIdPengaduan; ?>">

      <div class="row">
        <div class="col-25">
          <label for="subject">Subject:</label>
        </div>

        <div class="col-75">
          <textarea id="subject" name="editLaporanPengaduan" placeholder="ISI LAPORAN ..." style="height:200px"><?php echo $varLaporan; ?></textarea>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="subject">Foto:</label>
        </div>

        <div class="col-75">
          <label for="images">
            <input type="file" name="editFotoLaporanPengaduan" id="images" accept="image/*">
          </label>
        </div>

      </div>

      <br>
      <div class="row">
        <input type="submit" name="submitEditLaporanPengaduan" value="Submit">
      </div>

    </form>
  </div>
</div>
</body>
</html>