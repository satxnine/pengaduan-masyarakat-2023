<?php
	require '../koneksi.php';
	if($_SESSION['nik'] == ""){
		header('location: login.php');
	}
	else{
		$varNik = $_SESSION['nik'];

		$query = "SELECT * FROM pengaduan WHERE nik = '$varNik';";
		$result = mysqli_query($conn, $query);
	}

  
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
	<script type="text/javascript">
		function checkDelete(){
			return confirm('Yakin Data Ingin Dihapus?');
		}

    $(document).ready(function() {
      $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
	</script>
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
  text-align: justify;
  padding:10px
}

td{
  padding: 20px;
}

	</style>
	<title>RIWAYAT PENGADUAN MASYARAKAT</title>
</head>
<body>

	<div class="sidebar">
	  <a href="dashboard.php">DASHBOARD</a>
	  <a href="formPengaduan.php">FORM PENGADUAN</a>
	  <a class="active" href="riwayatPengaduan.php">RIWAYAT PENGADUAN</a>
	  <a href="logout.php">LOGOUT</a>
	</div>

	<div class="content">
		<h2>LIHAT RIWAYAT PENGADUAN</h2>
    <a href="laporan-pdf.php" target="_blank"><button class="btn btn-outline-secondary"> Cetak Laporan</button></a>
		<div class="container">
			<center>
				<table border="1">
					<tr>
						<th>ID</th>
						<th>Tanggal Pengaduan</th>
						<th>NIK</th>
						<th>Laporan</th>
						<th>Foto</th>
						<th>Status</th>
						<th>Action</th>
					</tr>

					<?php
					while ($data = mysqli_fetch_assoc($result)) {
					?>

					<tr>
						<td>
							<?php echo $data['id_pengaduan']; ?>
						</td>

						<td>
							<?php echo $data['tgl_pengaduan']; ?>
						</td>

						<td>
							<?php echo $data['nik']; ?>
						</td>

						<td>
							<?php echo $data['isi_laporan']; ?>
						</td>

						<td>
							<img src="../media/laporan/<?php echo $data['foto']; ?>" width="100px">
						</td>

						<td>
							<?php
								if($data['status'] == '0'){
									echo "Belum Ditanggapi";
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
								if($data['status'] == 'selesai'){
								?>

								<a href="lihatTanggapan.php?idPengaduan=<?php echo $data["id_pengaduan"] ?>">Lihat Tanggapan<i>&#x1F441;</i></a>
								<br><br>

								<?php
								}
								else{
								?>
								<a href="editPengaduan.php?edit=<?php echo $data["id_pengaduan"] ?>">edit<i>&#x270F;</i></a>
								<br><br>
								<a onclick="return checkDelete()" href="prosesUser.php?delete=<?php echo $data['id_pengaduan'] ?>">Delete<i>&#x1F5D1;</i></a>
								<?php
								}
							?>
							
						</td>
					</tr>

					<?php
					}
					?>

				</table>
			</center>
		</div>
	</div>

  
</body>
</html>