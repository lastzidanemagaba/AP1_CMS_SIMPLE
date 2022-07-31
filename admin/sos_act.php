<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Tambah"){
			$exe="INSERT INTO nomor_list VALUES(
			  '',
			  '".ucfirst($_POST['nama'])."',
			  '".($_POST['nomor'])."',
			  '1')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: sos?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE nomor_list SET
			  nama = '".ucfirst($_POST['nama'])."',
			  nomor = '".($_POST['nomor'])."',
			  status = '".($_POST['aktif'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			  
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: sos?alert=".md5("update"));
			}
		}else{
			header("location: sos?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['nomor']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE nomor_list SET status= '1' WHERE (md5(id) ='".$_GET['nomor']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE nomor_list SET status= '0' WHERE (md5(id) ='".$_GET['nomor']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "UPDATE nomor_list SET status= '2' WHERE (md5(id) ='".$_GET['nomor']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: sos?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: sos?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: sos?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}
	
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}
?>