<?php
require 'function.php';
require '../masyarakat/fungsi.php';
session_start();

if($_SESSION['nama_petugas'] == ""){
  header('location: login.php');
}
elseif($_SESSION['level'] != 'admin'){
  echo notifikasi('Anda tidak bisa membuka halaman ini', 'dashboard.php');
}
else{
  $registPetugas = new Registration();
  if(isset($_POST['submitRegistrasiPetugas'])){
    $varNamaPetugas = $_POST['namaRegistrasiPetugas'];
    $varUsernamePetugas = $_POST['usernameRegistrasiPetugas'];
    $varPasswordPetugas = $_POST['passwordRegistrasiPetugas'];
    $varTeleponPetugas = $_POST['teleponRegistrasiPetugas'];

    $result = $registPetugas->tambahPetugas($varNamaPetugas, $varUsernamePetugas, $varPasswordPetugas, $varTeleponPetugas);

    if($result == 1){
      echo notifikasi('Username telah terdaftar', 'tambahPetugas.php');
    }
    elseif($result == 10){
      echo notifikasi('Akun berhasil ditambah', 'lihatPetugas.php');
    }
    elseif($result == 100){
      echo notifikasi('Akun tidak berhasil ditambah', 'tambahPetugas.php');
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../CSS/style.css">
  <title>REGISTRASI PETUGAS PENGADUAN MASYARAKAT</title>
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
</head>

<body>
  <div class="sidebar">
    <a href="dashboard.php">DASHBOARD</a>
    <a href="lihatPengaduan.php">DAFTAR PENGADUAN</a>
    <?php
      if($_SESSION['level'] == 'admin'){
        echo "<a href='masyarakat.php'>MASYARAKAT</a><a href='tambahPetugas.php' class='active'>TAMBAH PETUGAS</a>
        <a href='lihatPetugas.php'>LIHAT PETUGAS</a>";
      }
    ?>
    <a href="logout.php">LOGOUT</a>
  </div>

  <div class="content2">
    <h2 style="text-align: center;">TAMBAH PETUGAS</h2>
    <div class="container">
      <form action="tambahPetugas.php" method="POST">
      <h2 style="text-align: center;">FORM REGISTRASI PETUGAS</h2>
      <div class="container">

        <label for="namaRegistrasiPetugas"><b>Nama Petugas:</b></label>
        <input type="text" placeholder="Enter Nama" name="namaRegistrasiPetugas" required>

        <label for="usernameRegistrasiPetugas"><b>Username:</b></label>
        <input type="text" placeholder="Enter Username" name="usernameRegistrasiPetugas" required>

        <label for="passwordRegistrasiPetugas"><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="passwordRegistrasiPetugas" required>

        <label for="teleponRegistrasiPetugas"><b>Telepon/HP:</b></label>
        <input type="text" placeholder="Enter Telepon/HP" name="teleponRegistrasiPetugas" required>
        
        <center> 
          <button type="submit" name="submitRegistrasiPetugas">Registrasi</button>
        </center> 

      </div>
    </form>
    </div>
  </div>
  
</body>
</html>