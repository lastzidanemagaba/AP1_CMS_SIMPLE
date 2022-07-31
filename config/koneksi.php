<?php
  
 date_default_timezone_set('Asia/Jakarta');

 //membuat koneksi dengan database
 $con = new mysqli('localhost','root','','u8671314_kiw_patrol') or die('Unable to Connect');
 //$con = new mysqli('localhost','root','','kiw_patrol') or die('Unable to Connect');
 $base_url = "../";

$sekarang = date('Y-m-d H:i:s');
$hari = date('m/d/Y');
$tanggal_sekarang = date('Y-m-d');
$bulan_sekarang = date('Y-m');
$bulantok_sekarang = date('m');
$tahun_sekarang = date('Y');

 
 ?>
