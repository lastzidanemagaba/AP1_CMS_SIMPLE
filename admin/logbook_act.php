<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Tambah"){
			$exe="INSERT INTO logbook_report VALUES(
			  '',
			  '".ucfirst($_POST['nama'])."',
			  '".($_POST['nomor'])."',
			  '1')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: logbook?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE logbook_report SET
			  nama = '".ucfirst($_POST['nama'])."',
			  perusahaan = '".ucfirst($_POST['perusahaan'])."',
			  nomor = '".($_POST['nomor'])."',
			  bertemu = '".($_POST['bertemu'])."',
			  tujuan = '".($_POST['tujuan'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			  
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: logbook?alert=".md5("update"));
			}
		}else{
			header("location: logbook?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['logbook']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE logbook_report SET status= '1' WHERE (md5(id) ='".$_GET['logbook']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE logbook_report SET status= '0' WHERE (md5(id) ='".$_GET['logbook']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "DELETE FROM logbook_report WHERE (md5(id) ='".$_GET['logbook']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: logbook?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: logbook?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: logbook?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}
	
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}
?>