<?php

 define('HOST','localhost');
 //define('USER','root');
 //define('PASS','');
 //define('DB','kiw_patrol');
  
 define('USER','u8671314_kiw');
 define('PASS','kiw_u8671314');
 define('DB','u8671314_kiw_patrol');
 
 date_default_timezone_set('Asia/Jakarta');
 
 $tanggal_sekarang = date('Y-m-d');
 $bulan_sekarang = date('Y-m');
 $bulantok_sekarang = date('m');
 $tahun_sekarang = date('Y');
 
 function tanggal($t){
    $tanggal = "";
    $tanggal = $t[8].$t[9]."-".$t[5].$t[6]."-".$t[0].$t[1].$t[2].$t[3];
    return $tanggal;
 } 
 
 function tanggal_lengkap($t){
    $tanggal = "";
    $tanggal = $t[8].$t[9]."-".$t[5].$t[6]."-".$t[0].$t[1].$t[2].$t[3]." ".$t[11].$t[12].":".$t[14].$t[15].":".$t[17].$t[18];
    $tanggal = $t[8].$t[9]."-".$t[5].$t[6]."-".$t[0].$t[1].$t[2].$t[3]." ".$t[11].$t[12].":".$t[14].$t[15];
    return $tanggal;
 }

 //membuat koneksi dengan database
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
 ?>
