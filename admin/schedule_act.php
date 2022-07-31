<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Add"){
			$exe="INSERT INTO jadwal_dinas VALUES(
			  '',
			  '".($_POST['id_user'])."',
			  '".($_POST['tanggal'])."',
			  '".($_POST['id_shift'])."')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: schedule?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE jadwal_dinas SET
			  tanggal = '".($_POST['tanggal'])."',
			  id_shift = '".($_POST['id_shift'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			  
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: schedule?alert=".md5("update"));
			}
		}else{
			header("location: schedule?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['jadwal']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE jadwal_dinas SET status= '1' WHERE (md5(id) ='".$_GET['jadwal']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE jadwal_dinas SET status= '0' WHERE (md5(id) ='".$_GET['jadwal']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "DELETE FROM jadwal_dinas WHERE (md5(id) ='".$_GET['jadwal']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: schedule?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: schedule?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: schedule?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}
	
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}
?>