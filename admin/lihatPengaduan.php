<?php
  
  require '../koneksi.php';

  if($_SESSION['nama_petugas'] == ""){
    header('location: login.php');
  }
  else{
    $sql = "SELECT * FROM pengaduan;";
    $result = mysqli_query($conn, $sql);

    if(isset($_POST['submitStatusPengaduan'])){
      $varIdPengaduan = $_POST['idLaporanPengaduanPengguna'];
      $varValueProsesStatus = $_POST['prosesStatusPengaduan'];

      $sql3 = "UPDATE pengaduan SET status='$varValueProsesStatus' WHERE id_pengaduan='$varIdPengaduan';";
      $result3 = mysqli_query($conn, $sql3);
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../CSS/style.css">
  <title>DASHBOARD PETUGAS PENGADUAN MASYARAKAT</title>
  <style>
    * {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

/*Form*/
.formLoginRegist{
  border: 3px solid #f1f1f1;
  margin: 10% 30% 10px 30%;
  border-radius: 8px;
}

form{
  border: 3px solid #f1f1f1;
  border-radius: 8px;
}

/*Input*/
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=text], textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

input[type=submit] {
  background-color: #003ce0;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #003ce0;
}

input[type=file] {
  color: #444;
  padding: 5px;
  background: #fff;
  border-radius: 10px;
  border: 1px solid #555;
}

input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #003ce0;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
}

input[type=number], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
}

button {
  background-color: #003ce0;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 65%;
  border-radius: 8px;
}

button:hover {
  opacity: 0.8;
}

/*div*/
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #003ce0;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

.content {
  margin-left: 200px;
  padding: 1px 16px;
  text-align: center;
  font-family: Georgia, 'Times New Roman', Times, serif;
}
.content2 {
  margin-left: 200px;
  padding: 1px 16px;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

#relative {
  background-color: #f1f1f1;
  padding: 13px;
  border-radius: 10px;
  position: relative;
  top: 25px;
  left: 10px;
  width: 99%;
  height: 150px;
}

#rela {
  background-color: #f1f1f1;
  padding: 1px;
  border-radius: 10px;
  position: relative;
  top: 15px;
  left: 10px;
  width: 99%;
  height: 50px;
  font-family: Georgia, 'Times New Roman', Times, serif;
}

table{
  border-collapse: collapse;
  text-align: justify;
}

th {
  text-align: center;
  padding:10px
}

td{
  padding: 20px;
}

</style>
</head>
<body>

  <div class="sidebar">
    <a href="dashboard.php">DASHBOARD</a>
    <a class="active" href="lihatPengaduan.php">DAFTAR PENGADUAN</a>
    <?php
      if($_SESSION['level'] == 'admin'){
        echo "<a href='masyarakat.php'>MASYARAKAT</a><a href='tambahPetugas.php' >TAMBAH PETUGAS</a>
        <a href='lihatPetugas.php'>LIHAT PETUGAS</a>";
      }
    ?>
    <a href="logout.php">LOGOUT</a>
  </div>

  <div class="content">
    <h2 style="text-align: center;">DAFTAR PENGADUAN MASYARAKAT</h2>

    <a href="../masyarakat/laporan-pdf.php" target="_blank"><button class="btn btn-secondary btn-sm"> Cetak Laporan</button></a>
    <div class="container">
      <center>
      <table border="1">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>Laporan</th>
          <th>Foto</th>
          <th>Status</th>
          <th>Action</th>
        </tr>

        <?php
        $nomor = 1;
        while ($data = mysqli_fetch_assoc($result)) {
          $nikPelapor = $data['nik'];
        ?>

        <tr>
          <td>
            <?php echo $nomor ?>
          </td>
          <td>
            <?php echo $data['tgl_pengaduan'] ?>
          </td>
          <td>
            <?php echo $nikPelapor ?>
          </td>
          <td>
            <?php
            $sql2 = "SELECT * FROM masyarakat WHERE nik='$nikPelapor';";
            $result2 = mysqli_query($conn, $sql2);
            $data2 = mysqli_fetch_assoc($result2);

            echo $data2['nama'];
            ?>
          </td>
          <td>
            <?php echo $data['isi_laporan'] ?>
          </td>
          <td>
            <img src="../media/laporan/ echo $data['foto'] ?>" width="100px">
          </td>
          <td>
            <?php
              if($data['status'] == '0'){
              ?>

              <form action="lihatPengaduan.php" method="POST">
                <input type="hidden" name="idLaporanPengaduanPengguna" value="<?php echo $data['id_pengaduan'] ?>">
                <select name="prosesStatusPengaduan">
                  <option value="0">Belum Ditanggapi</option>
                  <option value="proses">Verifikasi</option>
                </select>

                <input type="submit" name="submitStatusPengaduan" value="Submit">
              </form>

              <?php
              }
              elseif($data['status'] == 'proses'){
                echo "Sedang Diproses";
              }
              elseif($data['status'] == 'selesai'){
                echo "Laporan Selesai";
              }
              else{
                echo "Laporan Invalid";
              }
            ?>
          </td>
          <td>
            <?php
              if($data['status'] == '0'){
                echo "Silahkan Proses Status Terlebih Dahulu";
              }
              elseif($data['status'] == 'proses'){
              ?>

              <a href="prosesPengaduan.php?idPengaduan=<?php echo $data['id_pengaduan'] ?>">Lihat</a>

              <?php
              }
              elseif($data['status'] == 'selesai'){
              ?>
              <a href="lihatTanggapan.php?idPengaduan=<?php echo $data['id_pengaduan'] ?>">Lihat Tanggapan</a>
              <?php
              }
              else{
                echo "Laporan Invalid";
              }
            ?>
          </td>
        </tr>

        <?php
        $nomor = $nomor + 1;
        }
        ?>

      </table>
      </center>
    </div>

  </div>

</body>
</html>