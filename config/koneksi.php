<?php
  
 date_default_timezone_set('Asia/Jakarta');

 //membuat koneksi dengan database
$host = 'localhost'; // Nama hostnya
$username = 'root'; // Username
$password = ''; // Password (Isi jika menggunakan password)
$database = 'u8671314_kiw_patrol'; // Nama databasenya
$con = new mysqli($host,$username,$password,$database) or die('Unable to Connect');
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
$base_url = "../";

$sekarang = date('Y-m-d H:i:s');
$hari = date('m/d/Y');
$tanggal_sekarang = date('Y-m-d');
$bulan_sekarang = date('Y-m');
$bulantok_sekarang = date('m');
$tahun_sekarang = date('Y');

 
 ?>
