<?php

	require '../koneksi.php';
	require '../masyarakat/fungsi.php';

	if(isset($_POST['submitIsiTanggapanPengaduan'])){
		$varIdPengaduan = $_POST['idLaporanPengaduan'];
		$varTanggal = $tgl;
		$varIsiTanggapan = $_POST['tanggapanPetugas'];
		$varIdPetugas = $_SESSION['id_petugas'];

		$sql = "INSERT INTO tanggapan VALUES(null, '$varIdPengaduan', '$varTanggal', '$varIsiTanggapan', '$varIdPetugas');";
		$result = mysqli_query($conn, $sql);

		$sql2 = "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='$varIdPengaduan';";
		$result2 = mysqli_query($conn, $sql2);

		echo notifikasi('Pengaduan Berhasil Diberi Tanggapan', 'lihatPengaduan.php');
	}

?>