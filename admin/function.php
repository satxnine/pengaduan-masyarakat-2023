<?php
	
	class Connection{
		public $host = "localhost";
		public $user = "root";
		public $password = "";
		public $db_name = "db_pengaduan_masyarakat";
		public $conn;

		public function __construct(){
			$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
		}
	}

	class Signin extends Connection{
		public function login($username, $password){
			$password2 = md5($password);
			$result = mysqli_query($this->conn, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
			$login = mysqli_fetch_assoc($result);

			if(mysqli_num_rows($result) > 0){
				if($login['username'] == $username && $login['password'] == $password){
					$_SESSION['id_petugas'] = $login['id_petugas'];
					$_SESSION['nama_petugas'] = $login['nama_petugas'];
					$_SESSION['username'] = $login['username'];
					$_SESSION['password'] = $login['password'];
					$_SESSION['telpon'] = $login['telp'];
					$_SESSION['level'] = $login['level'];

					return 1;
					// Login Berhasil
				}
				else{
					return 10;
					// Username Atau Password Salah
				}
			}
			else{
				return 10;
				// Username Tidak Ditemukan
			}
		}
	}

	class Registration extends Connection{
		public function tambahPetugas($varNamaPetugas, $varUsernamePetugas, $varPasswordPetugas, $varTeleponPetugas){
			$sql = "SELECT * FROM petugas WHERE username='$varUsernamePetugas';";
			$result = mysqli_query($this->conn, $sql);

			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_assoc($result);

				if($row['username'] == $varUsernamePetugas){
					return 1;
					// Username atau akun sudah ada
				}
			}
			elseif(mysqli_num_rows($result) != 1){
				$varPasswordPetugas = md5($varPasswordPetugas);

				$sql = "INSERT INTO petugas VALUES(null, '$varNamaPetugas', '$varUsernamePetugas', '$varPasswordPetugas', '$varTeleponPetugas', 'petugas');";
				$result = mysqli_query($this->conn, $sql);

				return 10;
				// Akun Berhasil Ditambah
			}
			else{
				return 100;
				// Akun tidak berhasil ditambah
			}
		}
	}

?>