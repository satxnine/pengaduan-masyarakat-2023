<?php

	require '../koneksi.php';
	require 'fungsi.php';

	if(isset($_POST['submitRegistrasiPengguna'])){
		$varNik = $_POST['nikRegistrasiPengguna'];
		$varNama = $_POST['namaRegistrasiPengguna'];
		$varUsername = $_POST['usernameRegistrasiPengguna'];
		$varPassword = $_POST['passwordRegistrasiPengguna'];
		$varTelp = $_POST['teleponRegistrasiPengguna'];

		$sql = "SELECT * FROM masyarakat WHERE nik='$varNik';";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			if($row['nik'] == $varNik){
				echo notifikasi('NIK Sudah Terdaftar, Silahkan Gunakan NIK Yang Lain', 'registrasiAccount.php');
			}
		}

		elseif(mysqli_num_rows($result) != 1){
			$varPassword = md5($varPassword);

			$sql = "INSERT INTO masyarakat VALUES('$varNik', '$varNama', '$varUsername', '$varPassword', '$varTelp', '0');";
			$result = mysqli_query($conn, $sql);

			echo notifikasi('Registrasi Berhasil!', 'login.php');
		}

		else{
			echo notifikasi('Registrasi Tidak Berhasil!', 'registrasiAccount.php');
		}
	}

	elseif(isset($_POST['submitLoginPengguna'])){
		$varNik = $_POST['nikLoginPengguna'];
		$varPassword = $_POST['passwordLoginPengguna'];
		$varPassword = md5($varPassword);

		$sql = "SELECT * FROM masyarakat WHERE nik='$varNik' AND password='$varPassword' AND verifikasi = '1';";

		$result = mysqli_query($conn, $sql);
        $r = mysqli_num_rows($result);

echo($r);
		if(mysqli_num_rows($result) == 1) {
			$login = mysqli_fetch_assoc($result);

			if($login['nik'] == $varNik && $login['password'] == $varPassword){
				$_SESSION['nik'] = $login['nik'];
				$_SESSION['username'] = $login['username'];
				$_SESSION['password'] = $login['password'];
				$_SESSION['nama'] = $login['nama'];
				$_SESSION['telpon'] = $login['telp'];

				echo notifikasi('Login Berhasil!', 'dashboard.php');
			}
			else{
				echo notifikasi('NIK atau Password salah!', 'login.php');
			}
		}
		else{
			echo notifikasi('NIK atau Password salah!', 'login.php');
		}
	}
	elseif(isset($_POST['submitIsiLaporanPengaduan'])) {
		$varTanggal = $tgl;
		$varNik = $_SESSION['nik'];
		$varLaporan = $_POST['isiLaporanPengaduan'];
		$namaFoto = $tglAndWaktu.$_FILES['isiFotoLaporanPengaduan']['name'];
		$foto = $_FILES['isiFotoLaporanPengaduan']['tmp_name'];
		$status = '0';

		$sql = "INSERT INTO pengaduan VALUES(null, '$varTanggal', '$varNik', '$varLaporan', '$namaFoto', '$status');";
		move_uploaded_file($foto, '../media/laporan/'.$namaFoto);
		$result = mysqli_query($conn, $sql);

		echo notifikasi('Data Berhasil Ditambah!', 'riwayatPengaduan.php');
	}
	elseif(isset($_POST['submitEditLaporanPengaduan'])){
		$varNik = $_SESSION['nik'];
		$varIdPengaduan = $_POST['idLaporanPengaduan'];
		$varTanggalPengaduan = $tgl;
		$varIsiLaporan = $_POST['editLaporanPengaduan'];

		$query = "SELECT * FROM pengaduan WHERE (id_pengaduan='$varIdPengaduan' AND nik='$varNik');";
		$sql = mysqli_query($conn, $query);
		$result = mysqli_fetch_assoc($sql);

		if($_FILES['editFotoLaporanPengaduan']['name'] == ""){
			$varFoto = $result['foto'];
		}
		else{
			$varFoto = $tglAndWaktu.$_FILES['editFotoLaporanPengaduan']['name'];
			unlink("../media/laporan/".$result['foto']);
			move_uploaded_file($_FILES['editFotoLaporanPengaduan']['tmp_name'], "../media/laporan/".$varFoto);
		}

		$query = "UPDATE pengaduan SET tgl_pengaduan='$varTanggalPengaduan', isi_laporan='$varIsiLaporan', foto='$varFoto' WHERE (nik='$varNik' AND id_pengaduan='$varIdPengaduan');";

		$sql = mysqli_query($conn, $query);

		echo notifikasi('Data Berhasil Diedit', 'riwayatPengaduan.php');
	}

	elseif(isset($_GET['delete'])){
		$varIdPengaduan= $_GET['delete'];
		$varNik = $_SESSION['nik'];

		$query = "SELECT * FROM pengaduan WHERE (id_pengaduan='$varIdPengaduan' AND nik='$varNik');";
		$sql = mysqli_query($conn, $query);
		$result = mysqli_fetch_assoc($sql);

		if($result == NULL){
			echo notifikasi('Data Tidak Ditemukan', 'riwayatPengaduan.php');
		}
		elseif($result['status'] != '0'){
			echo notifikasi('Data Tidak Dapat Dihapus', 'riwayatPengaduan.php');
		}
		else{
			unlink("../media/laporan/".$result['foto']);
			$query2 = "DELETE FROM pengaduan WHERE (pengaduan.id_pengaduan='$varIdPengaduan' AND nik='$varNik');";
			$sql2 = mysqli_query($conn, $query2);
			echo notifikasi('Data Berhasil Dihapus', 'riwayatPengaduan.php');
		}
	}
	
?>