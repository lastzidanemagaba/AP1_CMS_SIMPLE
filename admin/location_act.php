<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Tambah"){
			$exe="INSERT INTO subarea_list VALUES(
			  '',
			  '".ucfirst($_POST['lokasi'])."',
			  '".ucfirst($_POST['alamat'])."',
			  '1',
			  '".($_POST['tag'])."',
			  '".($_POST['setelah'])."',
			  '".$sekarang."',
			  '1')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: location?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE subarea_list SET
			  subarea = '".ucfirst($_POST['lokasi'])."',
			  alamat = '".ucfirst($_POST['alamat'])."',
			  tag = '".ucfirst($_POST['tag'])."',
			  setelah = '".ucfirst($_POST['setelah'])."',
			  status = '".($_POST['aktif'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			  
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: location?alert=".md5("update"));
			}
		}else{
			header("location: location?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['lokasi']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE subarea_list SET status= '1' WHERE (md5(id) ='".$_GET['lokasi']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE subarea_list SET status= '0' WHERE (md5(id) ='".$_GET['lokasi']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "UPDATE subarea_list SET status= '2' WHERE (md5(id) ='".$_GET['lokasi']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: location?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: location?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: location?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}
	
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}
?>