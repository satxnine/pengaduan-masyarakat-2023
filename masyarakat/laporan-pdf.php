<!DOCTYPE html>
<html>
<head>
 <title>Laporan pengaduan cetak PDF</title>
</head>
<body>
 <style type="text/css">
 body{
 font-family: sans-serif;
 }
 table{
 margin: 20px auto;
 border-collapse: collapse;
 }
 table th,
 table td{
 border: 1px solid #3c3c3c;
 padding: 3px 8px;

 }
 a{
 background: blue;
 color: #fff;
 padding: 8px 10px;
 text-decoration: none;
 border-radius: 2px;
 }

    .tengah{
        text-align: center;
    }
 </style>
 <table>
 <tr>
 <th>ID</th>
 <th>Tanggal Pengaduan</th>
 <th>NIK</th>
 <th>Laporan</th>
 <th>Foto</th>
 <th>Status</th>
 </tr>
 <?php 
 // koneksi database
 $koneksi = mysqli_connect("localhost","root","","db_pengaduan_masyarakat");

 // menampilkan data pegawai
 $data = mysqli_query($koneksi,"select * from pengaduan");
 while($d = mysqli_fetch_array($data)){
 ?>
 <tr>
 <td style='text-align: center;'><?php echo $d['id_pengaduan'] ?></td>
 <td><?php echo $d['tgl_pengaduan']; ?></td>
 <td><?php echo $d['nik']; ?></td>
 <td><?php echo $d['isi_laporan']; ?></td>
 <td><?php echo $d['foto']; ?> </td>
 <td><?php echo $d['status']; ?> </td>
 </tr>
 <?php 
 }
 ?>
    </table>
    <script>
 window.print();
 </script>
</body>
</html>