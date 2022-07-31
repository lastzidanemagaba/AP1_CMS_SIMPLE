<?php 
session_start();
session_destroy();

include '../config/koneksi.php';

header("location: ".$base_url."index?alert=".md5("keluar"));
?>